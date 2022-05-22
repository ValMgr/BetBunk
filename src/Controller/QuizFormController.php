<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

use App\Services\FileUploader;
use App\Services\QuestionGenerator;
use App\Services\QuizzGenerator;

use App\Form\QuizFormType;
use App\Entity\QuizText;
use App\Entity\QuizCategory;
use App\Entity\Quiz;

class QuizFormController extends AbstractController
{

    function __construct(Security $security){
        $this->security = $security;
    }

    #[Route('/quiz/create/type', name: 'select_quiz_type')]
    public function chooseType(Request $request){
        return $this->render('quiz/select_type.html.twig');
    }

    #[Route('/quiz/create', name: 'createQuiz')]
    public function createQuiz(Request $request, EntityManagerInterface $entityManager): Response
    {

        $quiz = $_GET['type'] === 'text' ? new QuizText() : new QuizzCategory();
        $form = $this->createForm(QuizFormType::class, $quiz);
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid()) {
          
            $data = $form->getData();

            $quiz->setImage($form->get('image')->getData());
            $quiz->setThumbnail($form->get('thumbnail')->getData());
            $quiz->setUserId($this->security->getUser());
            $quiz->setTitle($form->get('title')->getData());
            $quiz->setDescription($form->get('description')->getData());
            $quiz->setNote(0);
            $quiz->setTime($form->get('time')->getData());

            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('quizzes');
        }
        

        return $this->render('quiz/create.html.twig', [
            'QuizForm' => $form->createView(),
        ]);
    }

}
