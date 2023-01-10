<?php

namespace App\Controller;

use App\Entity\KeyCategory;
use App\Form\KeyCategoryType;
use App\Repository\KeyCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/key/category')]
class AdminKeyCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_key_category_index', methods: ['GET'])]
    public function index(KeyCategoryRepository $keyCategoryRepository): Response
    {
        return $this->render('admin_key_category/index.html.twig', [
            'key_categories' => $keyCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_key_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KeyCategoryRepository $keyCategoryRepository): Response
    {
        $keyCategory = new KeyCategory();
        $form = $this->createForm(KeyCategoryType::class, $keyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyCategoryRepository->save($keyCategory, true);

            return $this->redirectToRoute('app_admin_key_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_key_category/new.html.twig', [
            'key_category' => $keyCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_key_category_show', methods: ['GET'])]
    public function show(KeyCategory $keyCategory): Response
    {
        return $this->render('admin_key_category/show.html.twig', [
            'key_category' => $keyCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_key_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, KeyCategory $keyCategory, KeyCategoryRepository $keyCategoryRepository): Response
    {
        $form = $this->createForm(KeyCategoryType::class, $keyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyCategoryRepository->save($keyCategory, true);

            return $this->redirectToRoute('app_admin_key_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_key_category/edit.html.twig', [
            'key_category' => $keyCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_key_category_delete', methods: ['POST'])]
    public function delete(Request $request, KeyCategory $keyCategory, KeyCategoryRepository $keyCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$keyCategory->getId(), $request->request->get('_token'))) {
            $keyCategoryRepository->remove($keyCategory, true);
        }

        return $this->redirectToRoute('app_admin_key_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
