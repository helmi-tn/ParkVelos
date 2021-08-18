<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\CategorieSite;
use App\Form\CategorieSiteType;
use App\Repository\SiteRepository;
use App\Repository\CircuitRepository;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\CategorieSiteController;
use App\Repository\CategorieSiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieSiteController extends AbstractController
{
     /**
     * @Route("/CategorieSite", name="show_categoriesite")
     */
    public function show(CategorieSiteRepository $repo): Response
    {
        $categoriesites = $repo->findAll();

        return $this->render('table/categsite.html.twig',['categoriesites'=>$categoriesites]);
    }

      /**
      * @Route("/CategorieSite/new", name="new_categorie_site")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $categ_site = new categorieSite();

        $form = $this->createForm(CategorieSiteType::class,$categ_site);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($categ_site);
            $manager->flush();

            return $this->redirectToRoute('show_categoriesite');
        }

        return $this->render('create/new_categorie_site.html.twig', [
            'form_categ_site' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/CategorieSite/delete/{id}" , name="delete_categorie_site")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $categ_site = $this->getDoctrine()->getRepository(CategorieSite::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categ_site);
        $entityManager->flush();
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('show_categoriesite');
      }
    /**
     * @Route("/CategorieSite/display/{id}", name="display_categ_site")
     */
    public function display($id) {
        $categ_site = $this->getDoctrine()->getRepository(CategorieSite::class)->find($id);
  
        return $this->render('display/display_categ_site.html.twig', ['categ_site' => $categ_site]);
      }
    /**
     * @Route("/CategorieSite/edit/{id}", name="edit_categ_site")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
      $categ_site = new CategorieSite();
      $categ_site = $this->getDoctrine()->getRepository(CategorieSite::class)->find($id);

      $form = $this->createForm(CategorieSiteType::class,$categ_site);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('show_categoriesite');
      }

      return $this->render('edit/edit_categ_site.html.twig', [
        'form_categ_site' => $form->createView()]
      );
    }
}
