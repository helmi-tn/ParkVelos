<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Circuit;
use App\Entity\Categorie;
use App\Entity\CategorieSite;
use App\Form\CategorieSiteType;
use App\Repository\SiteRepository;
use App\Repository\CircuitRepository;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategorieSiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VeloController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/show_categories_sites", name="show_categoriesite")
     */
    public function categorieSite(CategorieSiteRepository $repo): Response
    {
        $categoriesites = $repo->findAll();

        return $this->render('show/categsite.html.twig',['categoriesites'=>$categoriesites]);
    }
    /**
     * @Route("/show_categories_circuits", name="show_categoriescircuits")
     */
    public function categorieCircuits(CategorieRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('show/categcircuit.html.twig',['categories'=>$categories]);
    }
    /**
     * @Route("/show_sites", name="show_sites")
     */
    public function sites(SiteRepository $repo): Response
    {
        $sites = $repo->findAll();
        return $this->render('show/site.html.twig', ['sites'=>$sites]);
    }
    /**
     * @Route("/show_circuits", name="show_circuits")
     */
    public function circuits(CircuitRepository $repo): Response
    {
        $circuits = $repo->findAll();
        return $this->render('show/circuit.html.twig', ['circuits'=>$circuits]);
    }

    /**
     * @Route("/show_categories_sites/delete/{id}" , name="delete_categorie_site")
     * @Method({"DELETE"})
     */
    public function delete_categorie_site(Request $request, $id) {
        $categ_site = $this->getDoctrine()->getRepository(CategorieSite::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categ_site);
        $entityManager->flush();
        exit();
        $response = new Response();
        $response->send();
      }
    
     /**
     * @Route("/show_categories_circuits/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete_categorie_circuit(Request $request, $id) {
        $categ = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categ);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
    /**
     * @Route("/show_circuits/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete_circuit(Request $request, $id) {
        $circuit = $this->getDoctrine()->getRepository(Circuit::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($circuit);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      }
      
       /**
     * @Route("/show_sites/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete_site(Request $request, $id) {
        $site = $this->getDoctrine()->getRepository(Site::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($site);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
    
     /**
      * @Route("/new_site", name="new_site")
      */
      public function new_site(){
          return $this->render('create/new_site.html.twig');
      }
      /**
      * @Route("/new_categorie_site", name="new_categorie_site")
      */
      public function new_categorie_site(Request $request, EntityManagerInterface $manager){
        $categ_site = new categorieSite();

       // $form = $this->createFormBuilder($categ_site)
                     //->add('nom')
                     //->getForm();
        $form = $this->createForm(CategorieSiteType::class,$categ_site);
        $form->handleRequest($request);
        
        dump($categ_site);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($categ_site);
            $manager->flush();

            return $this->redirectToRoute('show_categoriesite');
        }

        return $this->render('create/new_categorie_site.html.twig', [
            'form_categ_site' => $form->createView()
        ]);
    }


   
}
