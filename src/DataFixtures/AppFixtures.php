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

        $bien1 = new Bien(1,"Activités Equestres, Apiculture, Chasse","Propriété Charente-Maritime","0",330000,"St sulpice de royan","17200","17",$categEX,"17.03.017","17.03.017");
        $bien2 = new Bien(2,"FERME 100% HERBAGERE/ ELEVAGE LAITIER","Située à l'orée d'un bourg, à 10 minutes des services et commerces.","1",950,"Rennes","35200","34",$categEX,"19.07.118","19.07.118");
        $bien3 = new Bien(3,"Propriété Creuse","Dans un hameau à moins de 10 minutes d'un bourg avec services et commerces, et d'un village ayant un intérêt touristique sur les routes de St-Jacques-de-Compostelle.","1",860,"Creuse","23320","1",$categBA,"23.16.104","23.16.104");
        $bien4  = new Bien(4, "Propriété Gard", "Ensemble immobilier proche d'un plan d'eau aménagé","1",2000,"Montpellier","34290","29",$categEX,"30VI9700","30VI9700");
        $bien5  = new Bien(5, "Idéale société de chasse", "Terrain boisé classé ONF","0",120000,"Lannion","22700","35",$categBO,"313453DR","313453DR");
        $bien6 = new Bien(6, 'Sapinière', 'Sapinière en cours de bail, cherche reprise', "1", 800, 'Rennes', '35200', '2',$categBO,"344334UJ","344334UJ");
        $bien7 = new Bien(7, 'Bois sur pied', 'Diverses essences sur place', '0', 30000, 'Quimper', '29510', '6',$categBO,"344334UJ","344334UJ");
        $bien8 = new Bien(8, 'Tourisme rural-hébergement', 'Au nord de l\'Hérault, proche des axes routiers et à 45 minutes de Montpellier', '0', 1490000, 'Montpellier', '34070', '2',$categBA, "34AG10897","34AG10897");
        $bien9 = new Bien(9, 'Propriété viticole et sa cave', 'Au coeur de l\'appellation Saint-Chinian', '0', 1500000, 'Montpellier', '34280', '30',$categBA,"34VI6979","34VI6979");
        $bien10 = new Bien(10, 'Vallons du Voironnais', '13 Ha de terrain', '1', 2000, 'Montpellier', '38500', '13',$categTA, "38TB22187","38TB22187");
        $bien11 = new Bien(11, 'Prairies en pays glazik', 'Usage petits animaux type caprins', '0', 15000, '15000', '29510', '1',$categPR,"43LM220118","43LM220118");
        $bien12 = new Bien(12, 'Bâtiments avicoles à transmettre', 'Site avicole à transmettre sur la commune de Nort-sur-Erdre, au nord de Nantes.', '0', 200000, 'Nantes', '44220', '2',$categBA,"44 22 AN 08","44 22 AN 08");
        $bien13 = new Bien(13, 'PRET A USAGE sur 95 ha - PLAINE DES VOSGES ', ' A 5 min de Villeneuve-sur-Lot', '1', 11000, 'Agen', '47300', '14',$categTA,"47.06.098","47.06.098");
        $bien14 = new Bien(14, 'Propriété Lozère', 'Ensemble bâti avec environ 1ha55', '1', 700, 'Badaroux', '48370', '1',$categBA,"48EL11345","48EL11345");
        $bien15 = new Bien(15, 'Situé à 15 minutes de Mende', 'idéal pour polyculture sur 14 ha', '1', 1300, 'Nîmes', '30430', '10',$categTA,"48RE11201","48RE11201");
        $bien16 = new Bien(16, 'Propriété Meuse', 'FERME DE COURUPT : Secteur Sainte-Menehould / Clermont-en-Argonne / Revigny', '1', 950, 'Epinal', '88340', '59',$categEX,"55VS","55VS");
        $bien17 = new Bien(17, 'Ancienne ferme équestre en ruine', 'Terrains actuellement loués', '0', 15600, 'Pont-labbé', '29510', '12',$categTA,"5667DB","5667DB");
        $bien18 = new Bien(18, 'Productions végétales', 'La parcelle se situe dans le Béarn sur la commune de LAGOR.', '0', 7700, 'Pau', '64150', '2',$categPR,"64.02.59","64.02.59");
        $bien19 = new Bien(19, 'Propriété située dans un secteur vallonné', 'Propriété Pyrénées-Atlantiques', '1', 650, 'Sainte-Feyre', '23500', 6,$categBA,'64.03.60','64.03.60');
        $bien20= new Bien(20, 'Terrain classé T4', 'cloturé et partiellement boisé', '1', 500, 'Morbihan', '56500', '1',$categBO,'65.23.876','65.23.876');
        $bien21 = new Bien(21, 'Prairies sur les plateaux', 'Parcelle de terre labourable d\'environ 2 ha', '0', 400000, 'Albi', '81090', '76',$categPR,'7629CA','7629CA');
        $bien22 = new Bien(22, 'Prairies orientées nord ouest', 'Lot d\'un seul tenant', '0', 113000, 'Morbihan', '56500', '11',$categPR,'765DN','765DN');
        $bien23 = new Bien(23, 'Terrain proche cours d\'eau', 'Non accessible par la route, uniquement chemin d\'exploitation', '1', 3000, 'Rennes', '35200', '5',$categPR,'76RZDC','76RZDC');
        $bien24= new Bien(24, 'Secteur du Ségala-Viaur', 'les secteurs les plus en pente sont empiérés', '0', 400000, 'Villefranche-de-Rouergue', '12200', '54',$categBO,'81EL11100','81EL11100');
        $bien25 = new Bien(25, 'Vittel Dombrot : Ouest vosgien, secteur de VITTEL', 'Terrains d\'environ 6,5 ha', '0', 6500, 'Epinal', '88170', '6',$categTA,'88 FB','88 FB');
        $bien26 = new Bien(26, 'Terrain avec abri', 'Pour propriétaire équin', '1', 1200, 'Nantes', '44110', '1',$categPR,'9875RDC','9875RDC');
        $bien27 = new Bien(27, 'Exploitation Agricole spécialisée en polyculture élevage', 'Exploitation située dans le Sud Est de La Sarthe, entre la commune d\'Ecommoy (72220) et Sarc? (72327)', '0', 75000, 'Le Mans', '72220', '87',$categEX,'AA 72 22 0088 R','AA 72 22 0088 R');
        $bien28 = new Bien(28, 'Propriété Calvados', 'JFD : Noue de Sienne (14)', '0', 173440, 'Caen', '14380', '17',$categEX,'MQ14170356 ','MQ14170356');
        $bien29 = new Bien(29, 'Bois domainial', 'Bois accessible avec sentiers', '1', 12000, 'Nantes', '44110', '32',$categBO,'QDSGF56','QDSGF56');
        $bien30 = new Bien(30, 'Légérement en Pente', 'Idéal paturage moutons', '1', 1000, '2400', 'Lannion', '22700',$categPR,'Z34.345.45','Z34.345.45');




        $manager->persist($categTA);
        $manager->persist($categPR);
        $manager->persist($categBO);
        $manager->persist($categBA);
        $manager->persist($categEX);

        $manager->persist($bien1);
        $manager->persist($bien2);
        $manager->persist($bien3);
        $manager->persist($bien4);
        $manager->persist($bien5);
        $manager->persist($bien6);
        $manager->persist($bien7);
        $manager->persist($bien8);
        $manager->persist($bien9);
        $manager->persist($bien10);
        $manager->persist($bien11);
        $manager->persist($bien12);
        $manager->persist($bien13);
        $manager->persist($bien14);
        $manager->persist($bien15);
        $manager->persist($bien16);
        $manager->persist($bien17);
        $manager->persist($bien18);
        $manager->persist($bien19);
        $manager->persist($bien20);
        $manager->persist($bien21);
        $manager->persist($bien22);
        $manager->persist($bien23);
        $manager->persist($bien24);
        $manager->persist($bien25);
        $manager->persist($bien26);
        $manager->persist($bien27);
        $manager->persist($bien28);
        $manager->persist($bien29);
        $manager->persist($bien30);

        $manager->flush();
    }
}
