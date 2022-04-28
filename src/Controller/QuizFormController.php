<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


use App\Form\QuizFormType;
use App\Entity\Quiz;

class QuizFormController extends AbstractController
{

    #[Route('/quiz/form/create', name: 'createQuiz')]
    public function createQuiz(Request $request): Response
    {

        $quiz = new Quiz();
        $form = $this->createForm(QuizFormType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $thumbnail = $form->get('thumbnail')->getData();

            if ($thumbnail) {
                $originalFilename = pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$thumbnail->guessExtension();

                try {
                    $thumbnail->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $product->setBrochureFilename($newFilename);
            }

            return $this->redirectToRoute('account');
        }
        
        return $this->render('quiz/createQuiz.html.twig ', [
            'QuizForm' => $form->createView(),
        ]);
    }
}
