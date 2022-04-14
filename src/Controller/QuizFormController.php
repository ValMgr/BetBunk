<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

            return $this->redirectToRoute('account');
        }
        
        return $this->render('quiz_form/createQuiz.html.twig ', [
            'QuizForm' => $form->createView(),
        ]);
    }
}
