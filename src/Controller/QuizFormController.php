<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;




use App\Form\QuizFormType;
use App\Entity\Quiz;

class QuizFormController extends AbstractController
{

    #[Route('/quiz/form/create', name: 'createQuiz')]
    public function createQuiz(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {

        $quiz = new Quiz();
        $form = $this->createForm(QuizFormType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $thumbnail = $form->get('thumbnail')->getData();

            if ($thumbnail) {
                $originalFilenameThumbnails = pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilenameThumbnails = $slugger->slug($originalFilenameThumbnails);
                $newFilenameThumbnails = $safeFilenameThumbnails.'-'.uniqid().'.'.$thumbnail->guessExtension();

                try {
                    $thumbnail->move(
                        $this->getParameter('thumbnails_directory'),
                        $newFilenameThumbnails
                    );
                } catch (FileException $e) {
                }

                $quiz->setThumbnail($newFilenameThumbnails);
            }
            
            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilenameImages = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilenameImages = $slugger->slug($originalFilenameImages);
                $newFilenameImages = $safeFilenameImages.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('images_directory'),
                        $newFilenameImages
                    );
                } catch (FileException $e) {
                }

                $quiz->setImage($newFilenameImages);
            }

            $user = $this->security->getUser();
            $title = $form->get('title')->getData();
            $description = $form->get('description')->getData();
            $note = $form->get('note')->getData();
            $time = $form->get('time')->getData();

            $quiz-> setUserId($user);
            $quiz-> setTitle($title);
            $quiz-> setDescription($description);
            $quiz-> setNote($note);
            $quiz-> setTime($time);

            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('QuizForm');
        }
        
        return $this->render('quiz/createQuiz.html.twig ', [
            'QuizForm' => $form->createView(),
        ]);
    }

    #[Route('/quiz/form/show/{id}', name: 'showQuiz')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $quiz = $doctrine->getRepository(Quiz::class)->find($id);

        if (!$quiz) {
            throw $this->createNotFoundException(
                'No quiz for id '.$id
            );
        }

        dd($quiz);
        return $this->render('quiz_form/index.html.twig ', [
            'quiz' => $quiz,
        ]);
    }
}
