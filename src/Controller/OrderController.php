<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Project;
use App\Repository\OrderRepository;
use App\Repository\ProjectRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order/add/{id}', name: 'app_order')]
    public function save(Request $request , Project $project, ProjectRepository $projectRepository, OrderRepository $orderRepository  ): Response
    {
        $order = new Order();
        $projectId = $project->getId();
        $order->setProject($projectRepository->find($projectId));
        $order->setOrderAt(new \DateTimeImmutable());
        $order->setStatus('shipped');
        $orderRepository->save($order, true);
        $session = $request->getSession();
        $session->getFlashBag()->add('success', 'Votre commande a été effectuée avec succès');
        return $this->redirectToRoute('app_project_list', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/order/list', name: 'app_order_list')]
    public function list(OrderRepository $orderRepository , CustomerRepository $customerRepository , ProjectRepository $projectRepository): Response
    {
        $customerId = $this->getUser()->getCustomer()->getId();
        $customer = $customerRepository->find($customerId);
        $projects = $projectRepository->findByCustomer($customer);
        $orders = [];
        
        foreach($projects as $project) {
            $orders[] = $orderRepository->findByProject($project);
        };
        

        
        return $this->renderForm('order/list.html.twig', [
            'orders' => $orders,
        ]);
    }
}
