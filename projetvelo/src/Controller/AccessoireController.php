<?php

namespace App\Controller;


use Gedmo\Sluggable\Util\Urlizer;
use App\Entity\Accessoire;
use App\Form\AccessoireType;
use App\Repository\AccessoireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccessoireController extends AbstractController
{
     /**
     * @Route("/accessoires", name="show_accessoires")
     */
    public function show(AccessoireRepository $repo): Response
    {
        $accessoires = $repo->findAll();

        return $this->render('table/accessoire.html.twig',['accessoires'=>$accessoires]);
    }
    
      /**
      * @Route("/accessoires/new", name="new_accessoire")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $accessoire = new Accessoire();

        $form = $this->createForm(AccessoireType::class,$accessoire);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $uploadedFile = $form['image']->getData();
          if ($uploadedFile) {
              $destination = $this->getParameter('kernel.project_dir').'/public/uploads/accessoire_image';
              $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
              $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
              $uploadedFile->move(
                  $destination,
                  $newFilename
              );
            $accessoire->setImage($newFilename);
          }
            $manager->persist($accessoire);
            $manager->flush();

            return $this->redirectToRoute('show_accessoires');
        }

        return $this->render('create/new_accessoire.html.twig', [
            'form_accessoire' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/accessoires/delete/{id}" , name="delete_accessoire")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $accessoire = $this->getDoctrine()->getRepository(Accessoire::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($accessoire);
        $entityManager->flush();
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('show_accessoires');
      }
      /**
     * @Route("/accessoires/display/{id}", name="display_accessoire")
     */
    public function display($id) {
        $accessoire = $this->getDoctrine()->getRepository(Accessoire::class)->find($id);
  
        return $this->render('display/display_accessoire.html.twig', ['accessoire' => $accessoire]);
      }

     /**
     * @Route("/accessoires/edit/{id}", name="edit_accessoire")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $accessoire = new Accessoire();
        $accessoire = $this->getDoctrine()->getRepository(Accessoire::class)->find($id);
  
        $form = $this->createForm(AccessoireType::class,$accessoire);
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
            
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('show_accessoires');
        }
  
        return $this->render('edit/edit_accessoire.html.twig', [
          'form_accessoire' => $form->createView()]
        );
      }
}
