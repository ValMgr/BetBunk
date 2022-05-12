<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// use App\Entity\Quiz;
use App\Entity\QuizText;
use App\Entity\QuizCategory;

use App\Entity\Question;
use App\Entity\Category;

class QuizFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $quiz = new QuizText();
        $quiz->setTitle('Spécialités culinaires de Bordeaux');
        $quiz->setDescription('Trouvez les spécialités culinaires de Bordeaux');
        $quiz->setThumbnail('/private/var/folders/f8/lqk8_h9d03d3tcj4_4cfp4xw0000gn/T/phpcA4r1z');
        $quiz->setImage('');
        $quiz->setNote(0);
        $quiz->setTime(180);
        $quiz->setUserId(1);

        $q1_1 = new Question();
        $q1_1->setAnswer('Cannelés');
        $q1_2 = new Question();
        $q1_2->setAnswer('Vin');
        $q1_3 = new Question();
        $q1_3->setAnswer('Lamproie');
        $q1_4 = new Question();
        $q1_4->setAnswer('Gratton');
        $q1_5 = new Question();
        $q1_5->setAnswer('Lillet');

        $manager->persist($quiz);
        $manager->flush();
    }
}
