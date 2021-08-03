<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CircuitController extends AbstractController
{
     /**
     * @Route("/Circuit", name="show_circuits")
     */
    public function circuits(CircuitRepository $repo): Response
    {
        $circuits = $repo->findAll();
        return $this->render('table/circuit.html.twig', ['circuits'=>$circuits]);
    }

     /**
     * @Route("/Circuit/delete/{id}" , name="delete_circuit")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $circuit = $this->getDoctrine()->getRepository(Circuit::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($circuit);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      }
    /**
      * @Route("/Circuit/new", name="new_circuit")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $circuit = new Circuit();

        $form = $this->createForm(CircuitType::class,$circuit);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($circuit);
            $manager->flush();

            return $this->redirectToRoute('show_circuit');
        }

        return $this->render('create/new_circuit.html.twig', [
            'form_circuit' => $form->createView()
        ]);
      }
    /**
     * @Route("/Circuit/display/{id}", name="display_circuit")
     */
    public function display($id) {
      $circuit = $this->getDoctrine()->getRepository(Circuit::class)->find($id);

      return $this->render('display/display_circuit.html.twig', ['circuit' => $circuit]);
    }
    /**
     * @Route("/Circuit/edit/{id}", name="edit_circuit")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
      $circuit = new Circuit();
      $circuit = $this->getDoctrine()->getRepository(Circuit::class)->find($id);

      $form = $this->createForm(CircuitType::class,$circuit);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('show_circuits');
      }

      return $this->render('edit/edit_circuit.html.twig', [
        'form_circuit' => $form->createView()]
      );
    }
      
}
