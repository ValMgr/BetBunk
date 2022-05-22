<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

use App\Entity\User;

class UserFixtures extends Fixture implements FixtureInterface, OrderedFixtureInterface
{

    public function getOrder(){
        return 1;
    }

    public function __construct(PasswordHasherFactoryInterface $encoderFactory){
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager): void
    {
  
        $password = $this->encoderFactory->getPasswordHasher(User::class)->hash('password', null);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@betbunk.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($password);
        $admin->setExperience(rand(0, 300000));
        $manager->persist($admin);

        $dev = new User();
        $dev->setUsername('dev');
        $dev->setEmail('dev@betbunk.com');
        $dev->setRoles(['ROLE_ADMIN']);
        $dev->setPassword($password);
        $dev->setExperience(rand(0, 300000));
        $manager->persist($dev);

        for($i=0;$i < 10; $i++){
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setEmail('user'.$i.'@betbunk.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($password);
            $user->setExperience(rand(0, 300000));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
