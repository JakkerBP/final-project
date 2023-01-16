<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{

    #[Route('customer/{id}', name: 'app_register_details', methods: ['GET', 'POST'])]
    public function details(UserRepository $userRepository , CustomerRepository $customerRepository): Response
    {   
        $customerId = $this->getUser()->getCustomer()->getId();
        $customer = $customerRepository->find($customerId);
        $user = $userRepository->find($customer);
        // dd($customer);
        

        return $this->render('customer/details.html.twig', [
            'controller_name' => 'CustomerController',
            'customer' => $customer,
            'user' => $user,
        ]);
    } 
    #[Route('customer/{id}/edit', name: 'app_register_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,UserRepository $userRepository, User $user, Customer $customer, CustomerRepository $customerRepository): Response
   
    {   
        
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            return $this->redirectToRoute('home_user', [], Response::HTTP_SEE_OTHER);
        }

        // return $this->render('registration/edit.html.twig', [
            return $this->render('registration/edit.html.twig', [
            'registrationForm' => $form->createView(),
            'user' => $user,
            'form' => $form,
            'customer' => $customer,
            
        ]);    
    } 


}
