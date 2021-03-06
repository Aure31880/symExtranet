<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_profile")
     */
    public function userProfile(): Response
    {
        return $this->render('user/updateProfile.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
