<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnexeController extends AbstractController
{
    /**
     * @Route("/annexe", name="cgv")
     */
    public function index(): Response
    {
        return $this->render('annexe/cgv.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    /**
     * @Route("/annexe/apropos", name="apropos")
     */
    public function apropos(): Response
    {
        return $this->render('annexe/apropos.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    /**
     * @Route("/annexe/cookies", name="cookies")
     */
    public function cookies(): Response
    {
        return $this->render('annexe/cookies.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    
}
