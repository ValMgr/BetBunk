<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

use App\Entity\User;
use App\Entity\QuizText;

use App\Entity\Question;
use App\Entity\Category;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class QuizTextFixtures extends Fixture implements FixtureInterface, OrderedFixtureInterface
{

    public function getOrder(){
        return 2;
    }

    public function __construct(ParameterBagInterface $params){
        $this->params = $params;
    }

    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->findOneByUsername('admin');
        $thumb = new File($this->params->get('thumbnails_directory').'/ah64d.jpg');
        $thumbName = $thumb->getFilename();
        $thumbSize = $thumb->getSize();


        $quiz_1 = new QuizText();
        $quiz_1->setTitle('Spécialités culinaires de Bordeaux');
        $quiz_1->setDescription('Trouvez les spécialités culinaires de Bordeaux');
        $quiz_1->setThumbnail($thumb);
        $quiz_1->setThumbnailName($thumbName);
        $quiz_1->setThumbnailSize($thumbSize);
        $quiz_1->setNote(0);
        $quiz_1->setTime(180);
        $quiz_1->setUserId($user);

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
        
        $quiz_1->addQuestion($q1_1);
        $quiz_1->addQuestion($q1_2);
        $quiz_1->addQuestion($q1_3);
        $quiz_1->addQuestion($q1_4);
        $quiz_1->addQuestion($q1_5);

        $manager->persist($quiz_1);

        $quiz_2 = new QuizText();
        $quiz_2->setTitle('Les noms et prénoms des gens de la classe');
        $quiz_2->setDescription('Trouvez les noms et prénoms des gens de la classe');
        $quiz_2->setThumbnail($thumb);
        $quiz_2->setThumbnailName($thumbName);
        $quiz_2->setThumbnailSize($thumbSize);
        $quiz_2->setNote(0);
        $quiz_2->setTime(180);
        $quiz_2->setUserId($user);

        $q2_1 = new Question();
        $q2_1->setAnswer('Valentin Magry');
        $q2_2 = new Question();
        $q2_2->setAnswer('Thomas Afonso');
        $q2_3 = new Question();
        $q2_3->setAnswer('Kanelle Lorent');
        $q2_4 = new Question();
        $q2_4->setAnswer('Keshia Mukenge');
        $q2_5 = new Question();
        $q2_5->setAnswer('Elisa Bourg');
        $q2_6 = new Question();
        $q2_6->setAnswer('Florian Vanderput');
        $q2_7 = new Question();
        $q2_7->setAnswer('Clémence Larouy');
        $q2_8 = new Question();
        $q2_8->setAnswer('Marie Maunoury');

        $quiz_2->addQuestion($q2_1);
        $quiz_2->addQuestion($q2_2);
        $quiz_2->addQuestion($q2_3);
        $quiz_2->addQuestion($q2_4);
        $quiz_2->addQuestion($q2_5);
        $quiz_2->addQuestion($q2_6);
        $quiz_2->addQuestion($q2_7);
        $quiz_2->addQuestion($q2_8);
    
        $manager->persist($quiz_2);

        $manager->flush();
    }
}
