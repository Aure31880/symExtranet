<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Actor;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ActorRepository;
use App\Repository\CommentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/comments/{id}", name="partner_comments")
     */
    public function partnerComments(ActorRepository $repoActor, $id, Request $request, ManagerRegistry $manager): Response
    {
        $actor = $repoActor->find($id);

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        // Créer les constraints pour valider formulaire puis récuperer variable username sans ça pas d'envoie à la bdd
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->getManager()->persist($comment);
            $manager->getManager()->flush();

            return $this->redirectToRoute('partner_comments', ['id' => $actor->getId()]);
        }
        return $this->render('partner/comment.html.twig', [
            'controller_name' => 'PartnerController',
            'actor' => $actor,
            'formComment' => $form->createView()

        ]);
    }
}
