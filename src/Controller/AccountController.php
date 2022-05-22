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
        $xp = $user->getExperience();

        // Calculate the user's level based on his experience
        $level = 1;
        while ($xp >= $level * (1000 * $level/10)) {
            $level++;
        }

        // Calculate user experience needed to reach the next level
        $xp_to_next_level = $level * (1000 * $level/10) - $xp;
        // Calculate current level percentage
        $xp_percentage = floor($xp / ($level * (1000 * $level/10)) * 100);
        // Calculate current experience from percentage of xp needed to reach the next level
        $xp_from_percentage = floor($xp_percentage * $xp_to_next_level / 100);


        return $this->render('user/account.html.twig', [
            'user' => $user,
            'level' => $level,
            'xp' => $xp_from_percentage ,
            'xp_required' => $xp_to_next_level,
            'xp_percentage' => $xp_percentage,
            'lastPlayedQuiz' => [],
            'quizzes' => [],
        ]);
    }
}
