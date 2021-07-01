<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UpdateProfilType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateProfilController extends AbstractController
{
    /**
     * @Route("/update/profil/{id}", name="update_profil")
     */
    public function UpdateProfil(User $user, Request $request, ManagerRegistry $manager): Response
    {

        if ($this->getUser()) {
            $form = $this->createForm(UpdateProfilType::class, $user);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $username = $user->getUsername();

                $user->setUsername($username);

                //$manager->getManager()->persist($user);
                $manager->getManager()->flush();

                return $this->redirectToRoute('update_profil', ['id' => $user->getId()]);
            }
        }

        return $this->render('update_profil/profil.html.twig', [
            'controller_name' => 'UpdateProfilController',
            'formUpdateProfil' => $form->createView(),


        ]);
    }
}
