<?php

namespace App\QuizFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Quiz;

class QuizFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $quiz = new Quiz();
        $quiz->setTitle('Quiz N°1');
        $quiz->setDescription('Ce quiz sera un quiz sur les chiens');
        $quiz->setThumbnail('');
        $quiz->setImage('');
        $quiz->setNote(20);
        $quiz->setTime(180);
        $quiz->setUserId(1);

        $manager->persist($quiz);
        $manager->flush();
    }
}
