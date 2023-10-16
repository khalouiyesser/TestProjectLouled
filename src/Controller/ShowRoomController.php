<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\ShowRoom;
use App\Form\AddshowroomType;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use App\Repository\ShowRoomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowRoomController extends AbstractController
{
    #[Route('/show/room', name: 'app_show_room')]
    public function index(): Response
    {
        return $this->render('showroom/index.html.twig', [
            'controller_name' => 'ShowRoomController',
        ]);
    }
    #[Route('/showroom', name: 'showroom')]
    public function showroom(ShowRoomRepository $showRoomRepository): Response
    {

        $x = $showRoomRepository->findAll();
        return $this->render('showroom/show.html.twig', [
            'showroom' => $x
        ]);
    }
    #[Route('/addshowroom', name: 'addshowroom')]
    public function addshowroom(ManagerRegistry $manager, Request $req): Response
    {
        $em = $manager->getManager();
        $author = new ShowRoom();
        $form = $this->createForm(AddshowroomType::class,   $author);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('showroom');
        }

        return $this->renderForm('showroom/add.html.twig', [
            'f' => $form
        ]);
    }


    #[Route('/editshowroom/{id}', name: 'editshowroom')]
    public function editshowroom($id, ManagerRegistry $manager, ShowRoomRepository $authorrepo, Request $req): Response
    {
        // var_dump($id) . die();

        $em = $manager->getManager();
        $idData = $authorrepo->find($id);
        // var_dump($idData) . die();
        $form = $this->createForm(AddshowroomType::class, $idData);
        $form->handleRequest($req);

        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($idData);
            $em->flush();

            return $this->redirectToRoute('showroom');
        }

        return $this->renderForm('showroom/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/deleteshowroom/{id}', name: 'deleteshowroom')]
    public function deleteshowroom($id, ManagerRegistry $manager, ShowRoomRepository $repo): Response
    {
        $emm = $manager->getManager();
        $idremove = $repo->find($id);
        $emm->remove($idremove);
        $emm->flush();


        return $this->redirectToRoute('showroom');
    }






}
