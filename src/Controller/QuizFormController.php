<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

use App\Services\FileLoader;
use App\Services\QuestionGenerator;
use App\Services\QuizzGenerator;

use App\Form\QuizFormType;
use App\Entity\QuizText;
use App\Entity\QuizCategory;
use App\Entity\Quiz;

class QuizFormController extends AbstractController
{

    function __construct(FileLoader $fileLoader, Security $security){
        $this->fileLoader = $fileLoader;
        $this->security = $security;
    }

    #[Route('/quiz/create/type', name: 'select_quiz_type')]
    public function chooseType(Request $request){
        return $this->render('quiz/select_type.html.twig');
    }

    #[Route('/quiz/create', name: 'createQuiz')]
    public function createQuiz(Request $request, FileLoader $fileLoader, EntityManagerInterface $entityManager,
    QuestionGenerator $questionGenerator, QuizzGenerator $quizGenerator): Response
    {

        $quiz = $_GET['type'] === 'text' ? new QuizText() : new QuizzCategory();
        $form = $this->createForm(QuizFormType::class, $quiz);
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid()) {
          
            $data = $form->getData();

            $thumbnail = $form->get('thumbnail')->getData();
            if ($thumbnail) {
                $thumnbail = $this->fileLoader->registerFile($thumbnail, $this->getParameter('thumbnails_directory'));
                $quiz->setThumbnail($thumbnail);
            }
            
            $image = $form->get('image')->getData();
            if ($image) {
                $image = $this->fileLoader->registerFile($image, $this->getParameter('images_directory'));
                $quiz->setImage($image);
            }
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
