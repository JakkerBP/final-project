<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\Customer1Type;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/customer')]
class AdminCustomerController extends AbstractController
{
    #[Route('/', name: 'app_admin_customer_index', methods: ['GET'])]
    public function index(CustomerRepository $customerRepository): Response
    {
        // dd('salut');
        dd($customerRepository->findAll());
        return $this->render('admin_customer/index.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();
        $form = $this->createForm(Customer1Type::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->save($customer, true);

            return $this->redirectToRoute('app_admin_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_customer_show', methods: ['GET'])]
    public function show(Customer $customer): Response
    {
        return $this->render('admin_customer/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        $form = $this->createForm(Customer1Type::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->save($customer, true);

            return $this->redirectToRoute('app_admin_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_customer_delete', methods: ['POST'])]
    public function delete(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $customerRepository->remove($customer, true);
        }

        return $this->redirectToRoute('app_admin_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
