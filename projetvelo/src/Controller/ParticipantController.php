<?php

namespace App\Controller;

use App\Entity\Velo;
use App\Entity\Participant;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ParticipantRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParticipantController extends AbstractController
{
    /**
     * @Route("/participant", name="show_participants")
     */
    public function show(ParticipantRepository $repo): Response
    {
        $participants = $repo->findAll();
        

        return $this->render('table/participant.html.twig',['participants'=>$participants]);
    }

    /**
    * @Route("/participant/delete/{id}", name="delete_participant")
    * @Method({"DELETE"})
    */
    public function delete(Request $request, $id) {
        $participant = $this->getDoctrine()->getRepository(Participant::class)->find($id);
        $velos = $participant->getVelos();
        foreach($velos as $velo){
          $participant->removeVelo($velo);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($participant);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('show_participants');
      }

      /**
      * @Route("/participant/new", name="new_participant")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $participant = new Participant();

        $form = $this->createForm(ParticipantType::class,$participant);
        $participant->__construct();
        $form->handleRequest($request);
        
        
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($participant);
            $manager->flush();

            dump($participant);        }

        return $this->render('create/new_participant.html.twig', [
            'form_participant' => $form->createView()
        ]);
    }
    /**
     * @Route("/participant/display/{id}", name="display_participant")
     */
    public function display($id) {
        $participant = $this->getDoctrine()->getRepository(Participant::class)->find($id);
        dump($participant);


  
        return $this->render('display/display_participant.html.twig', ['participant' => $participant ]);
      }
    /**
     * @Route("/participant/edit/{id}", name="edit_participant")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $participant = new Participant();
        $participant = $this->getDoctrine()->getRepository(Participant::class)->find($id);
  
        $form = $this->createForm(ParticipantType::class,$participant);

       
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_participants');
        }
  
        return $this->render('edit/edit_participant.html.twig', [
          'form_participant' => $form->createView()]
        );
      }
}
