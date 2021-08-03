<?php

namespace App\Controller;

use App\Entity\Velo;
use App\Form\VeloType;
use App\Repository\VeloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VeloController extends AbstractController
{
    /**
     * @Route("/velo", name="show_velos")
     */
    public function velos(VeloRepository $repo): Response
    {
        $velos = $repo->findAll();
        return $this->render('table/velo.html.twig', ['velos'=>$velos]);
    }
    /**
     * @Route("/velo/delete/{id}" , name="delete_velo")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $velo = $this->getDoctrine()->getRepository(Velo::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($velo);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
      /**
      * @Route("/velo/new", name="new_velo")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $velo = new Velo();

        $form = $this->createForm(VeloType::class,$velo);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($velo);
            $manager->flush();

            return $this->redirectToRoute('show_velos');
        }

        return $this->render('create/new_velo.html.twig', [
            'form_velo' => $form->createView()
        ]);
      }
    /**
     * @Route("/velo/display/{id}", name="display_velo")
     */
    public function display($id) {
        $velo = $this->getDoctrine()->getRepository(Velo::class)->find($id);
  
        return $this->render('display/display_velo.html.twig', ['velo' => $velo]);
      }
    /**
     * @Route("/velo/edit/{id}", name="edit_velo")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $velo = new Velo();
        $velo = $this->getDoctrine()->getRepository(Velo::class)->find($id);
  
        $form = $this->createForm(VeloType::class,$velo);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_velos');
        }
  
        return $this->render('edit/edit_velo.html.twig', [
          'form_velo' => $form->createView()]
        );
      }
}
