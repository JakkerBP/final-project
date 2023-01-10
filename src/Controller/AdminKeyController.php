<?php

namespace App\Controller;

use App\Entity\Key;
use App\Form\KeyType;
use App\Repository\KeyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/key')]
class AdminKeyController extends AbstractController
{
    #[Route('/', name: 'app_admin_key_index', methods: ['GET'])]
    public function index(KeyRepository $keyRepository): Response
    {
        return $this->render('admin_key/index.html.twig', [
            'keys' => $keyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_key_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KeyRepository $keyRepository): Response
    {
        $key = new Key();
        $form = $this->createForm(KeyType::class, $key);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyRepository->save($key, true);

            return $this->redirectToRoute('app_admin_key_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_key/new.html.twig', [
            'key' => $key,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_key_show', methods: ['GET'])]
    public function show(Key $key): Response
    {
        return $this->render('admin_key/show.html.twig', [
            'key' => $key,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_key_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Key $key, KeyRepository $keyRepository): Response
    {
        $form = $this->createForm(KeyType::class, $key);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyRepository->save($key, true);

            return $this->redirectToRoute('app_admin_key_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_key/edit.html.twig', [
            'key' => $key,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_key_delete', methods: ['POST'])]
    public function delete(Request $request, Key $key, KeyRepository $keyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$key->getId(), $request->request->get('_token'))) {
            $keyRepository->remove($key, true);
        }

        return $this->redirectToRoute('app_admin_key_index', [], Response::HTTP_SEE_OTHER);
    }
}
