<?php

namespace App\Controller;


use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="show_clients")
     */
    public function clients(ClientRepository $repo): Response
    {
        $clients = $repo->findAll();
        return $this->render('table/client.html.twig', ['clients'=>$clients]);
    }
    /**
     * @Route("/client/delete/{id}" , name="delete_client")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($client);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
      }
      /**
      * @Route("/client/new", name="new_client")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $client = new Client();

        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('show_clients');
        }

        return $this->render('create/new_client.html.twig', [
            'form_client' => $form->createView()
        ]);
      }
    /**
     * @Route("/client/display/{id}", name="display_client")
     */
    public function display($id) {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
  
        return $this->render('display/display_client.html.twig', ['client' => $client]);
      }
    /**
     * @Route("/client/edit/{id}", name="edit_client")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $client = new Client();
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
  
        $form = $this->createForm(ClientType::class,$client);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_clients');
        }
  
        return $this->render('edit/edit_client.html.twig', [
          'form_client' => $form->createView()]
        );
      }
}
