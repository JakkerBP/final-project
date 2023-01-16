<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Customer;
use App\Form\ProjectType;
use App\Form\OwnAddCustomerType;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/', name: 'home_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/our-creations', name: 'ourC_user')]
    public function ourCreations(): Response
    {
        return $this->render('user/ourCreations.html.twig', [
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
    // #[Route('/customer/new', name: 'contact_user')]
    // public function new(UserInterface $user, Request $request, CustomerRepository $customerRepository): Response
    // {
    //     $customer = new Customer();
    //     $form = $this->createForm(OwnAddCustomerType::class, $customer);
        
    //     $userId = $user->getId();
    //     $form->get('user')->setData($userId);



    //     $form->handleRequest($request);


    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $customerRepository->save($customer, true);

    //         return $this->redirectToRoute('app_admin_customer_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('admin_customer/new.html.twig', [
    //         'customer' => $customer,
    //         'form' => $form,
    //     ]);
    // }
    

}
