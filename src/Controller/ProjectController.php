<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Project;
use App\Entity\Customer;
use App\Form\ProjectType;

use App\Entity\KeyCategory;
use App\Entity\ProjectCustomKey;
use App\Form\ProjectCustomKeyType;
use App\Repository\ProjectRepository;
use App\Repository\CustomerRepository;
use App\Repository\KeyCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    // #[Route('/project', name: 'app_project')]
    // public function index(): Response
    // {
    //     return $this->render('project/index.html.twig', [
    //         'controller_name' => 'ProjectController',
    //     ]);
    // }
    #[Route('/project/new', name: 'app_project_new')]
    public function newProject(Request $request ,KeyCategoryRepository $keyCategoryRepository ,ProjectRepository $projectRepository , UserInterface $userInterface, CustomerRepository $customerRepository): Response
    {
        
        $customerId = $this->getUser()->getCustomer()->getId();
        $project = new Project();
        $project->setCreatedAt(new \DatetimeImmutable);
        $customer = $customerRepository->find($customerId);
        $project->setCustomer($customer);
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        // $keyCategoryCatch = $keyCategoryRepository->findBy(
        //     ['id' => [1,2]],
        //     ['id' => 'ASC']
        // );
        // $project->addKeyCategory($keyCategoryCatch);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $projectRepository->save($project, true);

            return $this->redirectToRoute('app_project_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }
    #[Route('/project/list', name: 'app_project_list')]
    public function listProject( UserInterface $userInterface , ProjectRepository $projectRepository , CustomerRepository $customerRepository): Response
    {
        $customerId = $this->getUser()->getCustomer()->getId();
        $customer = $customerRepository->find($customerId);
        $creations = $projectRepository->findBy(
            ['customer' => $customer],
            ['id' => 'ASC']
        );

        // foreach ($creations as $creation) {
        //     # code...
        // }

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ListProject',
            'creations' => $creations
        ]);
    }
    #[Route('/project/edit/{id}', name: 'app_project_edit', methods: ['GET', 'POST'])]
    public function editProject(ProjectRepository $projectRepository , ): Response
    {
        
        $projectCustomKey = new ProjectCustomKey;
        $form = $this->createForm(ProjectCustomKeyType::class, $projectCustomKey);

        return $this->render('project/edit.html.twig', [
            'controller_name' => 'modificationProject',
            'form' => $form,
            
        ]);
    }
    #[Route('/project/test', name: 'app_project_test')]
    public function testProject(): Response
    {
        

        return $this->render('project/test.html.twig', [
            
        ]);
    }
    
}
