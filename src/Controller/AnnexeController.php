<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnexeController extends AbstractController
{
    /**
     * @Route("/cgv", name="cgv")
     */
    public function cgv(): Response
    {
        return $this->render('annexe/cgv.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    /**
     * @Route("/apropos", name="apropos")
     */
    public function apropos(): Response
    {
        return $this->render('annexe/apropos.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    /**
     * @Route("/cookies", name="cookies")
     */
    public function cookies(): Response
    {
        return $this->render('annexe/cookies.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
    
    /**
     * @Route("/cus", name="cus")
     */
    public function cus(): Response
    {
        return $this->render('annexe/cus.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq(): Response
    {
        return $this->render('annexe/faq.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('annexe/contact.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }

    /**
     * @Route("/rejoindre", name="rejoindre")
     */
    public function rejoindre(): Response
    {
        return $this->render('annexe/rejoindre.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }

    /**
     * @Route("/reseaux", name="reseaux")
     */
    public function reseaux(): Response
    {
        return $this->render('annexe/reseaux.html.twig', [
            'controller_name' => 'AnnexeController',
        ]);
    }
}
