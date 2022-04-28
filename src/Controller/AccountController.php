<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class AccountController extends AbstractController
{

    public function __construct(Security $security)
    {
       $this->security = $security;
    }


    #[Route('/account', name: 'account')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        $xp = 700;
        //  calculate level from player xp
        $level = floor(log($xp/100+1,2));
        $reqXp = 1800;

        return $this->render('user/account.html.twig', [
            'user' => $user,
            'level' => $level,
            'xp' => $xp,
            'xp_required' => $reqXp,
            'lastPlayedQuiz' => [],
            'quizzes' => [],
        ]);
    }
}
