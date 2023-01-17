<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Project;
use App\Entity\Customer;
use App\Form\ProjectType;

use App\Entity\KeyCategory;
use App\Entity\ProjectCustomKey;
use App\Repository\KeyRepository;
use App\Form\ProjectCustomKeyType;
use App\Repository\ProjectRepository;
use App\Repository\CustomerRepository;
use App\Repository\KeyCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProjectCustomKeyRepository;
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
    public function editProject(Project $project , Request $request, 
                                ProjectCustomKeyRepository $projectCustomKeyRepository,
                                KeyRepository $keyRepository): Response
    {
        
        $customerId = $this->getUser()->getCustomer()->getId();
        $projectCustomerId = $project->getCustomer()->getId();
        if($projectCustomerId !== $customerId){
            return $this->redirectToRoute('home_user', [], Response::HTTP_SEE_OTHER);
        }
        //Si un utlisateur essayer de passer par le querry string pour acceder a un
        //Project qui n'est pas le siens je le redirige vers la page d'accueil
        
        $projectCustomKeys = $project->getProjectCustomKeys()->getIterator()->getArrayCopy(); 
        //Récupération des keys associer a ce projet.

        $ids = []; 
        // Tableau de mes id de keyPreview

        $idsColor = []; 
        // Tableau de mes couleur de key

        
        foreach($projectCustomKeys as $data){ 
            $ids[] = $data->getKeyy()->getKeyPreview();
            //Hydrate mon tableau avec mes id de keyPreview

            $idsColor[$data->getKeyy()->getKeyPreview()] = $data->getColor(); 
            //Hydre mon tableay avec mes couleur de key
        }
        
        $projectCustomKey = new ProjectCustomKey;
        //Création d'un nouveau CustomKey

        $form = $this->createForm(ProjectCustomKeyType::class, $projectCustomKey);
        //Crée un form en utilisant le Type de projectCustomKey

        $form->handleRequest($request);
        //Récupère les données de mon formulaire

        if ($form->isSubmitted() && $form->isValid()) {
            $projectCustomKey->setProject($project);
            //Attribue mon Project a mon projectCustomKey

            $project->addProjectCustomKey($projectCustomKey);
            //Ajoute une keyCustom a mon projet

            $projectCustomKeyRepository->save($projectCustomKey, true);
            //Sauvegarde la keyCustom en BDD

            header("Refresh:0");

        }

        return $this->render('project/edit.html.twig', [
            'controller_name' => 'modificationProject',
            'form' => $form,
            'ids' => $ids,
            'idsColor' => $idsColor,
            
        ]);//Création de ma vue en lui passant les variables
    }
    #[Route('/project/test', name: 'app_project_test')]
    public function testProject(): Response
    {
        
        return $this->render('project/test.html.twig', [
            
        ]);
    }
    
}

// $keys = $keyRepository->findBy(criteria: [], orderBy: ['keyPreview' => 'ASC']); 
        // $keysSorted = [];
        // foreach($keys as $key) {
            
        //     $keysSorted[] = [
        //         intval($key->getKeypreview()) => $key->getId() 
        //     ];
        // }
        // dump($keysSorted);
        // ksort($keysSorted);
        // dd($keysSorted);
        // $a = [0 => 'First', 2 => 'Last', 1 => 'Middle', 10 => 'Msdfmslk'];
        // dump($a);
        // ksort($a);
        // dd($a);
        // dd($keysSorted);