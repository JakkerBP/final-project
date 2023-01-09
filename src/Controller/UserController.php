<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/home', name: 'home_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/our-creations', name: 'ourCreations_user')]
    public function ourCreations(): Response
    {
        return $this->render('user/ourCreations.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/list-creation', name: 'listC_user')]
    public function listCreation(): Response
    {
        return $this->render('user/listCreations.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/details-creation', name: 'detailsC_user')]
    public function detailsCreation(): Response
    {
        return $this->render('user/detailsCreation.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/modify-creation', name: 'modifyC_user')]
    public function modifyCreation(): Response
    {
        return $this->render('user/modificationCreation.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/new-creation', name: 'newC_user')]
    public function newCreation(): Response
    {
        return $this->render('user/formNewCreation.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/contact', name: 'contact_user')]
    public function contact(): Response
    {
        return $this->render('user/contact.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
