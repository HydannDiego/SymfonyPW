<?php

namespace App\DataFixtures;

use App\Entity\Bien;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categTA = new Categorie(1,"Terrain Agricole");
        $categPR = new Categorie(2,"Prairie");
        $categBO = new Categorie(3,"Bois");
        $categBA = new Categorie(4,"Batiments");
        $categEX = new Categorie(5,"Exploitations");

        $bien1 = new Bien(1,"Activités Equestres, Apiculture, Chasse","Propriété Charente-Maritime","0","330000","St sulpice de royan","17200","17",$categEX,"17.03.017");
        $bien2 = new Bien(2,"FERME 100% HERBAGERE/ ELEVAGE LAITIER","Située à l'orée d'un bourg, à 10 minutes des services et commerces.","1","950","Rennes","35200","34",$categEX,"19.07.118");

        $manager->persist($categTA);
        $manager->persist($categPR);
        $manager->persist($categBO);
        $manager->persist($categBA);
        $manager->persist($categEX);

        $manager->persist($bien1);
        $manager->persist($bien2);



        $manager->flush();
    }
}
