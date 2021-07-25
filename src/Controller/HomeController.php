<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Repository\ArticleRepository;
use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $evenementRepository, ArticleRepository $articleRepository,
                          CategorieRepository $categorieRepository, AuteurRepository $auteurRepository): Response
    {
        // Rechercher des données 
        $evenements =  $evenementRepository->findAll();
        $articles   =  $articleRepository->findAll();
        // sort($articles , );
        $categories =  $categorieRepository->findAll();
        $auteurs    =   $auteurRepository->findAll();
        // Affichage de la page accueil
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $evenements,
            'articles'   => $articles,
            'categories' => $categories,
            'auteurs'    => $auteurs
        ]);
    }
}
