<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;;

use App\Entity\User;

class UserFixtures extends Fixture
{

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
        $manager->persist($admin);

        $dev = new User();
        $dev->setUsername('dev');
        $dev->setEmail('dev@betbunk.com');
        $dev->setRoles(['ROLE_ADMIN']);
        $dev->setPassword($password);
        $manager->persist($dev);

        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setEmail('user1@betbunk.com');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($password);
        $manager->persist($user1);

        $manager->flush();
    }
}
