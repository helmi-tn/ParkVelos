<?php

namespace App\Controller;

use App\Form\VeloType;
use App\Entity\TailleVelo;
use App\Form\TailleVeloType;
use App\Repository\TailleVeloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TailleVeloController extends AbstractController
{
        /**
         * @Route("/taillevelo", name="show_taillevelos")
         */
        public function velos(TailleVeloRepository $repo): Response
        {
            $taillevelos = $repo->findAll();
            return $this->render('table/taillevelo.html.twig', ['taillevelos'=>$taillevelos]);
        }
    /**
     * @Route("/taillevelo/delete/{id}" , name="delete_taillevelo")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $taillevelo = $this->getDoctrine()->getRepository(TailleVelo::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($taillevelo);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('show_taillevelos');
      }
       /**
      * @Route("/taillevelo/new", name="new_taillevelo")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $taillevelo = new TailleVelo();

        $form = $this->createForm(TailleVeloType::class,$taillevelo);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($taillevelo);
            $manager->flush();

            return $this->redirectToRoute('show_taillevelos');
        }
        return $this->render('create/new_taillevelo.html.twig', [
            'form_taillevelo' => $form->createView()
        ]);
}
    /**
     * @Route("/taillevelo/display/{id}", name="display_taillevelo")
     */
    public function display($id) {
        $taillevelo = $this->getDoctrine()->getRepository(TailleVelo::class)->find($id);
  
        return $this->render('display/display_taillevelo.html.twig', ['taillevelo' => $taillevelo]);
      }
    /**
     * @Route("/taillevelo/edit/{id}", name="edit_taillevelo")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $taillevelo = new TailleVelo();
        $taillevelo = $this->getDoctrine()->getRepository(TailleVelo::class)->find($id);
  
        $form = $this->createForm(TailleVeloType::class,$taillevelo);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_taillevelos');
        }
  
        return $this->render('edit/edit_taillevelo.html.twig', [
          'form_taillevelo' => $form->createView()]
        );
      }

    }
