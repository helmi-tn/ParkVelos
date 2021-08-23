<?php

namespace App\Controller;


use App\Entity\Velo;
use DateTimeImmutable;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\VeloRepository;
use App\Form\PasserDateCommandeType;
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

        return $this->redirectToRoute('show_commandes');
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

      /**
       * @Route("commande/date/passer", name="new_commande")
       */
      public function passercommande(Request $request,VeloRepository $repo) : Response 
      {
        $passerdate = null;
        $entityManager = $this->getDoctrine()->getManager();

        $form_passerdate = $this->createForm(PasserDateCommandeType::class,$passerdate);
        $form_passerdate->handleRequest($request);
        
        $lesvelos = $repo->findAll();
        
        $commande = new Commande();
        if($form_passerdate->isSubmitted() && $form_passerdate->isValid()){
            $dates=$request->request->get('passer_date_commande');
            $Tdebutdate=explode('T',$dates['debutdate']);
            $Tfindate=explode('T',$dates['findate']);
            $debutdate =\DateTime::createFromFormat('Y-m-d', $Tdebutdate[0]);
            $findate =\DateTime::createFromFormat('Y-m-d', $Tfindate[0]);
            $lesvelos = $repo->findAll();
            $commande->setDebutdate($debutdate);
            $commande->setFindate($findate);
            $entityManager->persist($commande);
            $form = $this->createForm(CommandeType::class,$commande);
            $commande->__construct();
            $form->handleRequest($request);
          
          return $this->render('create/new_commande.html.twig', ['lesvelos' => $lesvelos ,
          'form_commande' => $form->createView(),'form_passerdate' => $form_passerdate->createView()
      ]);

        }
          $form = $this->createForm(CommandeType::class,$commande);
          $commande->__construct();
          $form->handleRequest($request);
          
  
          if($form->isSubmitted() && $form->isValid()){
              $commande->setCreatedAt(new \DateTimeImmutable());
              $entityManager->persist($commande);
              $entityManager->flush();
  
              return $this->redirectToRoute('show_commandes');
          }
          
  
         



        return $this->render('commander/passer_date.html.twig', [
            'form_passerdate' => $form_passerdate->createView()
        ]);
      }
}
