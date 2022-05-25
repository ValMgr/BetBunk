<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Quiz;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'quizzes')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $quizzes = $doctrine->getRepository(Quiz::class)->findAll();
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
            'quizzes' => $quizzes,
        ]);
    }

    #[Route('/quiz/play/{id}', name: 'quiz')]
    public function getQuiz(ManagerRegistry $doctrine, int $id): Response
    {
        $quiz = $doctrine->getRepository(Quiz::class)->find($id);
     
        if (!$quiz) {
            throw $this->createNotFoundException(
                'No quiz for id '.$id
            );
        }

        return $this->render('quiz/quiz.html.twig ', [
            'quiz' => $quiz,
        ]);
    }
}
