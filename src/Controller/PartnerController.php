<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PartnerController extends AbstractController
{
    /**
     * @Route("/partner", name="partner")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Actor::class);

        $actors = $repo->findAll();

        return $this->render('partner/index.html.twig', [
            'controller_name' => 'PartnerController',
            'partner' => $actors
        ]);
    }
}
