<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        // $evenementRepository= new EvenementRepository();
        $evenements = $evenementRepository->findAll();
        // dd($evenements);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $evenements
        ]);
    }
}
