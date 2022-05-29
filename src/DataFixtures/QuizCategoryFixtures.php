<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

use App\Entity\User;
use App\Entity\QuizCategory;

use App\Entity\Question;
use App\Entity\Category;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class QuizCategoryFixtures extends Fixture implements FixtureInterface, OrderedFixtureInterface
{

    public function getOrder(){
        return 3;
    }

    public function __construct(ParameterBagInterface $params){
        $this->params = $params;
    }

    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->findOneByUsername('admin');
        $thumb = new File($this->params->get('thumbnails_directory').'/F1-75.jpeg');
        $thumbName = $thumb->getFilename();
        $thumbSize = $thumb->getSize();

        $f1Quizz = new QuizCategory();
        $f1Quizz->setTitle('Pilotes F1 - Saison 2022');
        $f1Quizz->setDescription('Trouvez le nom de tous les pilotes de la saison 2022 de Formule 1');
        $f1Quizz->setThumbnail($thumb);
        $f1Quizz->setThumbnailName($thumbName);
        $f1Quizz->setThumbnailSize($thumbSize);
        $f1Quizz->setNote(0);
        $f1Quizz->setTime(120);
        $f1Quizz->setUserId($user);

        $pilote_1 = new Question();
        $pilote_1->setAnswer('Charles Leclerc');
        $pilote_2 = new Question();
        $pilote_2->setAnswer('Carlos Sainz');

        $category_Ferrari = new Category();
        $category_Ferrari->setName('Ferrari');
        $category_Ferrari->setColor('#A6051A');
        $category_Ferrari->addQuestion($pilote_1);
        $category_Ferrari->addQuestion($pilote_2);

        $pilote_3 = new Question();
        $pilote_3->setAnswer('Lewis Hamilton');
        $pilote_4 = new Question();
        $pilote_4->setAnswer('George Russell');

        $category_Mercedes = new Category();
        $category_Mercedes->setName('Mercedes');
        $category_Mercedes->setColor('#00A19C');
        $category_Mercedes->addQuestion($pilote_3);
        $category_Mercedes->addQuestion($pilote_4);

        $pilote_5 = new Question();
        $pilote_5->setAnswer('Max Verstappen');
        $pilote_6 = new Question();
        $pilote_6->setAnswer('Sergio Perez');

        $category_RedBull = new Category();
        $category_RedBull->setName('RedBull');
        $category_RedBull->setColor('#121F45');
        $category_RedBull->addQuestion($pilote_5);
        $category_RedBull->addQuestion($pilote_6);

        $pilote_7 = new Question();
        $pilote_7->setAnswer('Daniel Ricciardo');
        $pilote_8 = new Question();
        $pilote_8->setAnswer('Lando Norris');

        $category_McLaren = new Category();
        $category_McLaren->setName('McLaren');
        $category_McLaren->setColor('#F98E1D');
        $category_McLaren->addQuestion($pilote_7);
        $category_McLaren->addQuestion($pilote_8);

        $pilote_9 = new Question();
        $pilote_9->setAnswer('Fernando Alonso');
        $pilote_10 = new Question();
        $pilote_10->setAnswer('Esteban Ocon');

        $category_Alpine = new Category();
        $category_Alpine->setName('Alpine');
        $category_Alpine->setColor('#005BA9');
        $category_Alpine->addQuestion($pilote_9);
        $category_Alpine->addQuestion($pilote_10);

        $pilote_11 = new Question();
        $pilote_11->setAnswer('Sebastian Vettel');
        $pilote_12 = new Question();
        $pilote_12->setAnswer('Lance Stroll');

        $category_AstonMartin = new Category();
        $category_AstonMartin->setName('Aston Martin');
        $category_AstonMartin->setColor('#00352F');
        $category_AstonMartin->addQuestion($pilote_11);
        $category_AstonMartin->addQuestion($pilote_12);

        $pilote_13 = new Question();
        $pilote_13->setAnswer('Pierre Gasly');
        $pilote_14 = new Question();
        $pilote_14->setAnswer('Yuki Tsunoda');

        $category_AlphaTauri = new Category();
        $category_AlphaTauri->setName('AlphaTauri');
        $category_AlphaTauri->setColor('#00293F');
        $category_AlphaTauri->addQuestion($pilote_13);
        $category_AlphaTauri->addQuestion($pilote_14);

        $pilote_15 = new Question();
        $pilote_15->setAnswer('Valteri Bottas');
        $pilote_16 = new Question();
        $pilote_16->setAnswer('Guanyu Zhou');

        $category_AlphaRomeo = new Category();
        $category_AlphaRomeo->setName('AlphaRomeo');
        $category_AlphaRomeo->setColor('#981E32');
        $category_AlphaRomeo->addQuestion($pilote_15);
        $category_AlphaRomeo->addQuestion($pilote_16);

        $pilote_17 = new Question();
        $pilote_17->setAnswer('Mick Schumacher');
        $pilote_18 = new Question();
        $pilote_18->setAnswer('Kevin Magnussen');

        $category_Haas = new Category();
        $category_Haas->setName('Haas');
        $category_Haas->setColor('#F9F2F2');
        $category_Haas->addQuestion($pilote_17);
        $category_Haas->addQuestion($pilote_18);

        $pilote_19 = new Question();
        $pilote_19->setAnswer('Nicholas Latifi');
        $pilote_20 = new Question();
        $pilote_20->setAnswer('Alexander Albon');

        $category_Williams = new Category();
        $category_Williams->setName('Williams');
        $category_Williams->setColor('#00A3E0');
        $category_Williams->addQuestion($pilote_19);
        $category_Williams->addQuestion($pilote_20);

        $f1Quizz->addCategory($category_Ferrari);
        $f1Quizz->addCategory($category_Mercedes);
        $f1Quizz->addCategory($category_RedBull);
        $f1Quizz->addCategory($category_McLaren);
        $f1Quizz->addCategory($category_Alpine);
        $f1Quizz->addCategory($category_AstonMartin);
        $f1Quizz->addCategory($category_AlphaTauri);
        $f1Quizz->addCategory($category_AlphaRomeo);
        $f1Quizz->addCategory($category_Haas);
        $f1Quizz->addCategory($category_Williams);

        $manager->persist($f1Quizz);
        $manager->flush();
    }
}
