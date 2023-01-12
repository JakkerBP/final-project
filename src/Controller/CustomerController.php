<?php

namespace App\Controller;


use App\Entity\Customer;
use App\Form\UserToCustomerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{




    #[Route('/customer/new', name: 'app_customer')]
    public function new(UserInterface $user , ManagerRegistry $doctrine): Response
    {
        
        $userId = $user->getId();
    
        $customer = new Customer();
        $form = $this->createForm(UserToCustomerType::class, $customer);
        
        if(key_exists('user_to_customer', $_POST)){

            $addCustomer = $_POST['user_to_customer'];

            if(key_exists('phone',$addCustomer)){

                // var_dump($addCustomer);

                $phone = $addCustomer['phone'];
                $name = $addCustomer['name'];
                $surname = $addCustomer['surname'];
                $adress = $addCustomer['adress'];
                $userId = $user->getId();

                var_dump($phone , $name , $surname , $adress , $userId);
    
                $entityManager = $doctrine->getManager();
    
                $customer->setPhone($phone);
                $customer->setName($name);
                $customer->setSurname($surname);
                $customer->setAdress($adress);
                $customer->setUser($userId);
                
                $entityManager->persist($customer);
                $entityManager->flush();
    
                // header("location: https://127.0.0.1:8000/");
                // exit;
            }

        }
        
            
            return $this->renderForm('customer/new.html.twig', [
                'customer' => $customer,
                'form' => $form,
            ]);
    }
}
