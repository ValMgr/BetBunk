<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Quiz;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $quizzes = $doctrine->getRepository(Quiz::class)->findAll();
        $numberOfQuiz = count($quizzes);
        $randomQuiz = array_rand($quizzes, 1);
        $quizzes[$randomQuiz];
        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'quizzes' => $quizzes,
            'numberOfQuiz' => $numberOfQuiz,
            'randomQuiz' => $quizzes[$randomQuiz]
        ]);
    }
}
