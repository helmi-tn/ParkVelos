<?php

namespace App\Controller;

use App\Entity\Site;
use App\Form\SiteType;
use Gedmo\Sluggable\Util\Urlizer;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="show_sites")
     */
    public function sites(SiteRepository $repo): Response
    {
        $sites = $repo->findAll();
        return $this->render('table/site.html.twig', ['sites'=>$sites]);
    }
      /**
     * @Route("/site/delete/{id}" , name="delete_site")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $site = $this->getDoctrine()->getRepository(Site::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($site);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('show_sites');
      }
      /**
      * @Route("/site/new", name="new_site")
      */
      public function new(Request $request, EntityManagerInterface $manager){
        $site = new Site();

        $form = $this->createForm(SiteType::class,$site);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
          $uploadedFile = $form['image']->getData();
          if ($uploadedFile) {
              $destination = $this->getParameter('kernel.project_dir').'/public/uploads/site_image';
              $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
              $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
              $uploadedFile->move(
                  $destination,
                  $newFilename
              );
            $site->setImage($newFilename);
          }
            $manager->persist($site);
            $manager->flush();

            return $this->redirectToRoute('show_sites');
        }

        return $this->render('create/new_site.html.twig', [
            'form_site' => $form->createView()
        ]);
      }
    /**
     * @Route("/site/display/{id}", name="display_site")
     */
    public function display($id) {
      $site = $this->getDoctrine()->getRepository(Site::class)->find($id);

      return $this->render('display/display_site.html.twig', ['site' => $site]);
    }
    /**
     * @Route("/site/edit/{id}", name="edit_site")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
      $site = new Site();
      $site = $this->getDoctrine()->getRepository(Site::class)->find($id);

      $form = $this->createForm(SiteType::class,$site);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
        $uploadedFile = $form['image']->getData();
        if ($uploadedFile) {
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/site_image';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );
          $site->setImage($newFilename);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('show_sites');
      }

      return $this->render('edit/edit_site.html.twig', [
        'form_site' => $form->createView()]
      );
    }
}
