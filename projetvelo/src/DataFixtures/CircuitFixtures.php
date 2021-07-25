<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Circuit;
use App\Entity\Categorie;
use App\Entity\CategorieSite;
use App\Entity\Site;

class CircuitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($k=1;$k<=3;$k++){
            $categorieSite= new CategorieSite();
            $categorieSite->setNom("Categorie du site n$k");
            $manager->persist($categorieSite);

            $categorie=new Categorie();
            $categorie->setNom("Categorie du circuit n$k");
            $manager->persist($categorie);

            for($o=1;$o<=4;$o++){
                $site= new Site();
                $site->setNom("Nom du site n$o")
                     ->setIcon(null)
                     ->setDescription("Description du site n$o")
                     ->setMap("Map du site n$o")
                     ->setCategorieSite($categorieSite);
                $manager->persist($site);

            
                for($u=1;$u<=3;$u++){
                    $circuit = new Circuit();
                    $circuit->setNom("Nom du circuit n$u")
                            ->setDifficulte("Difficulte du circuit n$u")
                            ->setAttribut($u)
                            ->setImage(null)
                            ->setTrajectoire([])
                            ->setCategorie($categorie);
                    $manager->persist($circuit);
                }
            }

        }




     

        $manager->flush();
    }
}
