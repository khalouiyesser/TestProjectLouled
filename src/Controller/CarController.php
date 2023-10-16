<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car', name: 'app_car')]
    public function index(): Response
    {
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
        ]);
    }

    #[Route('/showcar', name: 'showcar')]
    public function showcar(CarRepository $showRoomRepository): Response
    {

        $x = $showRoomRepository->findAll();
        return $this->render('car/show.html.twig', [
            'showroom' => $x
        ]);
    }
    #[Route('/addcar', name: 'addcar')]
    public function addcar(ManagerRegistry $manager, Request $req): Response
    {
        $em = $manager->getManager();
        $author = new Car();
        $form = $this->createForm(CarType::class,   $author);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('showroom');
        }

        return $this->renderForm('car/add.html.twig', [
            'f' => $form
        ]);
    }


    #[Route('/editcar/{id}', name: 'editcar')]
    public function editcar($id, ManagerRegistry $manager, CarRepository $authorrepo, Request $req): Response
    {
        // var_dump($id) . die();

        $em = $manager->getManager();
        $idData = $authorrepo->find($id);
        // var_dump($idData) . die();
        $form = $this->createForm(CarType::class, $idData);
        $form->handleRequest($req);

        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($idData);
            $em->flush();

            return $this->redirectToRoute('showcar');
        }

        return $this->renderForm('car/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/deletecar/{id}', name: 'deletecar')]
    public function deletecar($id, ManagerRegistry $manager, CarRepository $repo): Response
    {
        $emm = $manager->getManager();
        $idremove = $repo->find($id);
        $emm->remove($idremove);
        $emm->flush();


        return $this->redirectToRoute('showcar');
    }

}
