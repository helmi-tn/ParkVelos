<?php

namespace App\Controller;


use DateTimeImmutable;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="show_commandes")
     */
    public function commandes(CommandeRepository $repo): Response
    {
        $commandes = $repo->findAll();
        return $this->render('table/commande.html.twig', ['commandes'=>$commandes]);
    }
    /**
     * @Route("/commande/delete/{id}" , name="delete_commande")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $commande = $this->getDoctrine()->getRepository(Commande::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commande);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
      /**
      * @Route("/commande/new", name="new_commande")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $commande = new Commande();

        $form = $this->createForm(CommandeType::class,$commande);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $commande->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($commande);
            $manager->flush();

            return $this->redirectToRoute('show_commandes');
        }

        return $this->render('create/new_commande.html.twig', [
            'form_commande' => $form->createView()
        ]);
      }
    /**
     * @Route("/commande/display/{id}", name="display_commande")
     */
    public function display($id) {
        $commande = $this->getDoctrine()->getRepository(Commande::class)->find($id);
  
        return $this->render('display/display_commande.html.twig', ['commande' => $commande]);
      }
    /**
     * @Route("/commande/edit/{id}", name="edit_commande")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $commande = new Commande();
        $commande = $this->getDoctrine()->getRepository(Commande::class)->find($id);
  
        $form = $this->createForm(CommandeType::class,$commande);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_commandes');
        }
  
        return $this->render('edit/edit_commande.html.twig', [
          'form_commande' => $form->createView()]
        );
      }
}