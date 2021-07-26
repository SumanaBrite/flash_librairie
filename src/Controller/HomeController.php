<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Repository\AuteurRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $evenementRepository, ArticleRepository $articleRepository,
                          CategorieRepository $categorieRepository, AuteurRepository $auteurRepository,
                         Session $session): Response
    {
        // Rechercher des données 
        $evenements =  $evenementRepository->findAll();
        $articles   =  $articleRepository->findAll();
        // sort($articles , );
        $categories =  $categorieRepository->findAll();
        $auteurs    =   $auteurRepository->findAll();

// voir la function hydrate, la session qui nous permet de chercher nos infos
        $isbn = $session->getFlashBag()->get('isbn', []) ;
        $titre = $session->getFlashBag()->get('titre', []);
        $description = $session->getFlashBag()->get('description', []);
        $message = $session->getFlashBag()->get('message', []);

        if (!$message){
            $message[0]="";
        }
         if (!$isbn) {
             $isbn[0] = "";
             $titre[0] = "";
             $description[0]="";
        //      $message[0]=$message;
        //  }
        //  else{
        //   $message[0]="";
         }
        
        // maintenant qu'on a les informations ... ou pas
        // on test, et si les infos sont là, on pré-rempli l'objet $article avant de l'envoyer dans le formulaire
        // un peu comme si on éditait le formulaire, sauf que dans ce cas là, l'objet n'existe pas encore dans la BDD
        // if ($isbn){ $article->setIsbn($isbn[0]);}
        // if ($nom){ $article->setNom($nom[0]);}
        // if ($auteur){ $article->setAuteur($auteur[0]);}


        // Affichage de la page accueil
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'evenements' => $evenements,
            'articles'   => $articles,
            'categories' => $categories,
            'auteurs'    => $auteurs,
            'isbn'       => $isbn[0],
            'titre'      => $titre[0],
            'description' => $description[0],
            'message'     => $message[0]
 

        ]);
    }
     /**
     * @Route("/find-the-book", name="home_hydrate", methods={"GET","POST"})
     */
    public function hydrate(Request $request): Response
    {
        // on récupère l'ISBN
        $isbn = $request->request->get('isbn_api');
        // on crée donc une fonction qui va consomer l'API et récupérer les données sous forme de tableau
        // bon, dans mon cas, je donne les infos en dur
        // $data = [
        //     'isbn' => "2228885657",
        //     'titre' => "Les échecs simples",
        //     'description' => "michael Stean",
        // ];
        
        $api = HttpClient::create();
    
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;

        $reponse = $api->request('GET', $url);
        $status_code = $reponse->getStatusCode();


      
        if ( $status_code == 200 ){
            $contenu = $reponse->getContent();
            $data = $reponse->toArray();

            $nbr_records = $data['totalItems'];
            if ($nbr_records) {
                $titre = $data['items'][0]['volumeInfo']['title'];
                // $isbn = $data['items'][0]['volumeInfo']['title'];
                $description = $data['items'][0]['volumeInfo']['description'];
                                                           
                $message= "";
            }
            else{
                $titre = ""; $description = ""; $isbn= "" ; $message= "ISBN incorrect";
            }
        

        } else{
            $titre = ""; $description = ""; $isbn= "" ; $message= "ISBN incorrect";
        }
           

        // OK, maintenant, on stock ces infos dans les flash bag (bag à usage unique, une fois lu, elle disparaissent)
        // en bref, les données sont stockées dans la session
        $this->addFlash('isbn', $isbn);
        $this->addFlash('titre', $titre);
        $this->addFlash('description', $description);
        $this->addFlash('message', $message);


        // et on repart vers notre formulaire ... avec des données dans la session
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
