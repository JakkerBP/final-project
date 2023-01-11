<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use App\Repository\AdressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/adress')]
class AdminAdressController extends AbstractController
{
    #[Route('/', name: 'app_admin_adress_index', methods: ['GET'])]
    public function index(AdressRepository $adressRepository): Response
    {
        return $this->render('admin_adress/index.html.twig', [
            'adresses' => $adressRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_adress_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdressRepository $adressRepository): Response
    {
        $adress = new Adress();
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adressRepository->save($adress, true);

            return $this->redirectToRoute('app_admin_adress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_adress/new.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_adress_show', methods: ['GET'])]
    public function show(Adress $adress): Response
    {
        return $this->render('admin_adress/show.html.twig', [
            'adress' => $adress,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_adress_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adress $adress, AdressRepository $adressRepository): Response
    {
        $form = $this->createForm(AdressType::class, $adress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adressRepository->save($adress, true);

            return $this->redirectToRoute('app_admin_adress_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_adress/edit.html.twig', [
            'adress' => $adress,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_adress_delete', methods: ['POST'])]
    public function delete(Request $request, Adress $adress, AdressRepository $adressRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adress->getId(), $request->request->get('_token'))) {
            $adressRepository->remove($adress, true);
        }

        return $this->redirectToRoute('app_admin_adress_index', [], Response::HTTP_SEE_OTHER);
    }
}
