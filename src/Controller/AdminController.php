<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function dashboard(CustomerRepository $customerRepository , OrderRepository $orderRepository): Response
    {
        $listCustomer = $customerRepository->findBy(array(), array('id' => 'DESC'), 4);
        $listOrder = $orderRepository->findBy(array(), array('id' => 'DESC'), 4);
        // dd($listCustomer , $listOrder);

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'listOrder' => $listOrder,
            'listCustomer' => $listCustomer,
        ]);
    }
}
