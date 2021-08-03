<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Controller\CategorieController;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/CategorieCircuit", name="show_categoriescircuits")
     */
    public function show(CategorieRepository $repo): Response
    {
        $categories = $repo->findAll();

        return $this->render('table/categcircuit.html.twig',['categories'=>$categories]);
    }
    
    /**
    * @Route("/CategorieCircuit/delete/{id}", name="delete_categorie_circuit")
    * @Method({"DELETE"})
    */
    public function delete(Request $request, $id) {
        $categ = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categ);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
       /**
      * @Route("/CategorieCircuit/new", name="new_categorie_circuit")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $categ_circ = new Categorie();

        $form = $this->createForm(CategorieType::class,$categ_circ);
        $form->handleRequest($request);
        
        dump($categ_circ);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($categ_circ);
            $manager->flush();

            return $this->redirectToRoute('show_categoriescircuits');
        }

        return $this->render('create/new_categorie_circ.html.twig', [
            'form_categ_circuit' => $form->createView()
        ]);
    }
    /**
     * @Route("/CategorieCircuit/display/{id}", name="display_categ_circuit")
     */
    public function display($id) {
        $categ_circ = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
  
        return $this->render('display/display_categ_circuit.html.twig', ['categ_circ' => $categ_circ]);
      }
    /**
     * @Route("/CategorieCircuit/edit/{id}", name="edit_categ_circuit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $categ_circuit = new Categorie();
        $categ_circuit = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
  
        $form = $this->createForm(CategorieType::class,$categ_circuit);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_categoriescircuits');
        }
  
        return $this->render('edit/edit_categ_circuit.html.twig', [
          'form_categ_circuit' => $form->createView()]
        );
      }
}
