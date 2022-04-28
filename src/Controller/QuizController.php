<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }
    
    #[Route('/quiz/{id}', name: 'showQuiz')]
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
