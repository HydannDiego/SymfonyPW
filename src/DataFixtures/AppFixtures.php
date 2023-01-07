<?php

namespace App\DataFixtures;

use App\Entity\Bien;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * On crée 30 objets Bien, chacun avec un titre, une description, un prix, etc.
     *
     * @param ObjectManager manager L'instance EntityManagerInterface.
     */
    public function load(ObjectManager $manager): void
    {
        $categTA = new Categorie();
        $categTA->setIntitule("Terrain Agricole");
        $categPR = new Categorie();
        $categPR->setIntitule("Prairie");
        $categBO = new Categorie();
        $categBO->setIntitule("Bois");
        $categBA = new Categorie();
        $categBA->setIntitule("Batiments");
        $categEX = new Categorie();
        $categEX->setIntitule("Exploitations");

        $bien1 = new Bien();
        $bien1->setTitre("Activités Equestres, Apiculture, Chasse");
        $bien1->setDescription("Propriété Charente-Maritime");
        $bien1->setCp("17200");
        $bien1->setVille("St sulpice de royan");
        $bien1->setIsLocatif("0");
        $bien1->setPrix("330000");
        $bien1->setSurface("17");
        $bien1->setRef("17.03.017");
        $bien1->setImage("17.03.017");
        $bien1->setIdCategorie($categEX);

        $bien2 = new Bien();
        $bien2->setTitre("FERME 100% HERBAGERE/ ELEVAGE LAITIER");
        $bien2->setDescription("Située à l'orée d'un bourg, à 10 minutes des services et commerces.");
        $bien2->setCp("35200");
        $bien2->setVille("Rennes");
        $bien2->setIsLocatif("1");
        $bien2->setPrix("950");
        $bien2->setSurface("34");
        $bien2->setRef("19.07.118");
        $bien2->setImage("19.07.118");
        $bien2->setIdCategorie($categEX);

        $bien3 = new Bien();
        $bien3->setTitre("Propriété Creuse");
        $bien3->setDescription("Dans un hameau à moins de 10 minutes d'un bourg avec services et commerces, et d'un village ayant un intérêt touristique sur les routes de St-Jacques-de-Compostelle.");
        $bien3->setCp("23320");
        $bien3->setVille("Creuse");
        $bien3->setIsLocatif("1");
        $bien3->setPrix("860");
        $bien3->setSurface("1");
        $bien3->setRef("23.16.104");
        $bien3->setImage("23.16.104");
        $bien3->setIdCategorie($categBA);

        $bien4 = new Bien();
        $bien4->setTitre("Propriété Gard");
        $bien4->setDescription("Ensemble immobilier proche d'un plan d'eau aménagé");
        $bien4->setCp("34290");
        $bien4->setVille("Montpellier");
        $bien4->setIsLocatif("1");
        $bien4->setPrix("2000");
        $bien4->setSurface("29");
        $bien4->setRef("30VI9700");
        $bien4->setImage("30VI9700");
        $bien4->setIdCategorie($categEX);

        $bien5 = new Bien();
        $bien5->setTitre("Idéale société de chasse");
        $bien5->setDescription("Terrain boisé classé ONF");
        $bien5->setCp("22700");
        $bien5->setVille("Lannion");
        $bien5->setIsLocatif("0");
        $bien5->setPrix("120000");
        $bien5->setSurface("35");
        $bien5->setRef("313453DR");
        $bien5->setImage("313453DR");
        $bien5->setIdCategorie($categBO);

        $bien6 = new Bien();
        $bien6->setTitre("Sapinière");
        $bien6->setDescription("Sapinière en cours de bail, cherche reprise");
        $bien6->setCp("35200");
        $bien6->setVille("Rennes");
        $bien6->setIsLocatif("1");
        $bien6->setPrix("800");
        $bien6->setSurface("2");
        $bien6->setRef("344334UJ");
        $bien6->setImage("344334UJ");
        $bien6->setIdCategorie($categBO);

        $bien7 = new Bien();
        $bien7->setTitre("Bois sur pied");
        $bien7->setDescription("Diverses essences sur place");
        $bien7->setCp("29510");
        $bien7->setVille("Quimper");
        $bien7->setIsLocatif("0");
        $bien7->setPrix("30000");
        $bien7->setSurface("6");
        $bien7->setRef("344334UJ");
        $bien7->setImage("344334UJ");
        $bien7->setIdCategorie($categBO);

        $bien8 = new Bien();
        $bien8->setTitre("Tourisme rural-hébergement");
        $bien8->setDescription("Au nord de l\'Hérault, proche des axes routiers et à 45 minutes de Montpellier");
        $bien8->setCp("34070");
        $bien8->setVille("Montpellier");
        $bien8->setIsLocatif("0");
        $bien8->setPrix("1490000");
        $bien8->setSurface("2");
        $bien8->setRef("34AG10897");
        $bien8->setImage("34AG10897");
        $bien8->setIdCategorie($categBA);

        $bien9 = new Bien();
        $bien9->setTitre("Propriété viticole et sa cave");
        $bien9->setDescription("Au coeur de l\'appellation Saint-Chinian");
        $bien9->setCp("34280");
        $bien9->setVille("Montpellier");
        $bien9->setIsLocatif("0");
        $bien9->setPrix("1500000");
        $bien9->setSurface("30");
        $bien9->setRef("34VI6979");
        $bien9->setImage("34VI6979");
        $bien9->setIdCategorie($categBA);

        $bien10 = new Bien();
        $bien10->setTitre("Vallons du Voironnais");
        $bien10->setDescription("13 Ha de terrain");
        $bien10->setCp("38500");
        $bien10->setVille("Montpellier");
        $bien10->setIsLocatif("1");
        $bien10->setPrix("2000");
        $bien10->setSurface("13");
        $bien10->setRef("38TB22187");
        $bien10->setImage("38TB22187");
        $bien10->setIdCategorie($categTA);

        $bien11 = new Bien();
        $bien11->setTitre("Prairies en pays glazik");
        $bien11->setDescription("Usage petits animaux type caprins");
        $bien11->setCp("29510");
        $bien11->setVille("Limosges");
        $bien11->setIsLocatif("0");
        $bien11->setPrix("15000");
        $bien11->setSurface("1");
        $bien11->setRef("43LM220118");
        $bien11->setImage("43LM220118");
        $bien11->setIdCategorie($categPR);

        $bien12 = new Bien();
        $bien12->setTitre("Bâtiments avicoles à transmettre");
        $bien12->setDescription("Site avicole à transmettre sur la commune de Nort-sur-Erdre, au nord de Nantes.");
        $bien12->setCp("44220");
        $bien12->setVille("Nantes");
        $bien12->setIsLocatif("0");
        $bien12->setPrix("200000");
        $bien12->setSurface("2");
        $bien12->setRef("44 22 AN 08");
        $bien12->setImage("44 22 AN 08");
        $bien12->setIdCategorie($categBA);

        $bien13 = new Bien();
        $bien13->setTitre("PRET A USAGE sur 95 ha - PLAINE DES VOSGES");
        $bien13->setDescription("A 5 min de Villeneuve-sur-Lot");
        $bien13->setCp("47300");
        $bien13->setVille("Agen");
        $bien13->setIsLocatif("1");
        $bien13->setPrix("11000");
        $bien13->setSurface("1");
        $bien13->setRef("47.06.098");
        $bien13->setImage("47.06.098");
        $bien13->setIdCategorie($categTA);

        $bien14 = new Bien();
        $bien14->setTitre("Propriété Lozère");
        $bien14->setDescription("Ensemble bâti avec environ 1ha55");
        $bien14->setCp("48370");
        $bien14->setVille("Badaroux");
        $bien14->setIsLocatif("1");
        $bien14->setPrix("700");
        $bien14->setSurface("1");
        $bien14->setRef("48EL11345");
        $bien14->setImage("48EL11345");
        $bien14->setIdCategorie($categBA);

        $bien15 = new Bien();
        $bien15->setTitre("Situé à 15 minutes de Mende");
        $bien15->setDescription("idéal pour polyculture sur 14 ha");
        $bien15->setCp("30430");
        $bien15->setVille("Nîmes");
        $bien15->setIsLocatif("1");
        $bien15->setPrix("1300");
        $bien15->setSurface("10");
        $bien15->setRef("48RE11201");
        $bien15->setImage("48RE11201");
        $bien15->setIdCategorie($categTA);

        $bien16 = new Bien();
        $bien16->setTitre("Propriété Meuse");
        $bien16->setDescription("FERME DE COURUPT : Secteur Sainte-Menehould / Clermont-en-Argonne / Revigny");
        $bien16->setCp("88340");
        $bien16->setVille("Epinal");
        $bien16->setIsLocatif("1");
        $bien16->setPrix("950");
        $bien16->setSurface("59");
        $bien16->setRef("55VS");
        $bien16->setImage("55VS");
        $bien16->setIdCategorie($categEX);

        $bien17 = new Bien();
        $bien17->setTitre("Ancienne ferme équestre en ruine");
        $bien17->setDescription("Terrains actuellement loués");
        $bien17->setCp("29510");
        $bien17->setVille("Pont-labbé");
        $bien17->setIsLocatif("0");
        $bien17->setPrix("1500");
        $bien17->setSurface("12");
        $bien17->setRef("5667DB");
        $bien17->setImage("5667DB");
        $bien17->setIdCategorie($categTA);

        $bien18 = new Bien();
        $bien18->setTitre("Productions végétales");
        $bien18->setDescription("La parcelle se situe dans le Béarn sur la commune de LAGOR.");
        $bien18->setCp("64150");
        $bien18->setVille("Pau");
        $bien18->setIsLocatif("0");
        $bien18->setPrix("7700");
        $bien18->setSurface("2");
        $bien18->setRef("64.02.59");
        $bien18->setImage("64.02.59");
        $bien18->setIdCategorie($categPR);

        $bien19 = new Bien();
        $bien19->setTitre("Propriété située dans un secteur vallonné");
        $bien19->setDescription("Propriété Pyrénées-Atlantiques");
        $bien19->setCp("23500");
        $bien19->setVille("Sainte-Feyre");
        $bien19->setIsLocatif("1");
        $bien19->setPrix("650");
        $bien19->setSurface("6");
        $bien19->setRef("64.03.60");
        $bien19->setImage("64.03.60");
        $bien19->setIdCategorie($categBA);

        $bien20 = new Bien();
        $bien20->setTitre("Terrain classé T4");
        $bien20->setDescription("cloturé et partiellement boisé");
        $bien20->setCp("56500");
        $bien20->setVille("Morbihan");
        $bien20->setIsLocatif("1");
        $bien20->setPrix("500");
        $bien20->setSurface("1");
        $bien20->setRef("65.23.876");
        $bien20->setImage("65.23.876");
        $bien20->setIdCategorie($categBO);

        $bien21 = new Bien();
        $bien21->setTitre("Prairies sur les plateaux");
        $bien21->setDescription("Parcelle de terre labourable d\'environ 2 ha");
        $bien21->setCp("81090");
        $bien21->setVille("Albi");
        $bien21->setIsLocatif("0");
        $bien21->setPrix("400000");
        $bien21->setSurface("76");
        $bien21->setRef("7629CA");
        $bien21->setImage("7629CA");
        $bien21->setIdCategorie($categPR);

        $bien22 = new Bien();
        $bien22->setTitre("Prairies orientées nord ouest");
        $bien22->setDescription("Lot d\'un seul tenant");
        $bien22->setCp("56500");
        $bien22->setVille("Morbihan");
        $bien22->setIsLocatif("0");
        $bien22->setPrix("113000");
        $bien22->setSurface("11");
        $bien22->setRef("765DN");
        $bien22->setImage("765DN");
        $bien22->setIdCategorie($categPR);

        $bien23 = new Bien();
        $bien23->setTitre("Terrain proche cours d\'eau");
        $bien23->setDescription("Non accessible par la route, uniquement chemin d\'exploitation");
        $bien23->setCp("35200");
        $bien23->setVille("Rennes");
        $bien23->setIsLocatif("1");
        $bien23->setPrix("3000");
        $bien23->setSurface("5");
        $bien23->setRef("76RZDC");
        $bien23->setImage("76RZDC");
        $bien23->setIdCategorie($categPR);

        $bien24 = new Bien();
        $bien24->setTitre("Secteur du Ségala-Viaur");
        $bien24->setDescription("Propriété Charente-Maritime");
        $bien24->setCp("12200");
        $bien24->setVille("Villefranche-de-Rouergue");
        $bien24->setIsLocatif("0");
        $bien24->setPrix("400000");
        $bien24->setSurface("54");
        $bien24->setRef("81EL11100");
        $bien24->setImage("81EL11100");
        $bien24->setIdCategorie($categBO);

        $bien25 = new Bien();
        $bien25->setTitre("Vittel Dombrot : Ouest vosgien, secteur de VITTEL");
        $bien25->setDescription("Terrains d\'environ 6,5 ha");
        $bien25->setCp("88170");
        $bien25->setVille("Epinal");
        $bien25->setIsLocatif("0");
        $bien25->setPrix("6500");
        $bien25->setSurface("6");
        $bien25->setRef("88 FB");
        $bien25->setImage("88 FB");
        $bien25->setIdCategorie($categTA);

        $bien26 = new Bien();
        $bien26->setTitre("Terrain avec abri");
        $bien26->setDescription("Pour propriétaire équin");
        $bien26->setCp("44110");
        $bien26->setVille("Nantes");
        $bien26->setIsLocatif("1");
        $bien26->setPrix("1200");
        $bien26->setSurface("1");
        $bien26->setRef("9875RDC");
        $bien26->setImage("9875RDC");
        $bien26->setIdCategorie($categPR);

        $bien27 = new Bien();
        $bien27->setTitre("Exploitation Agricole spécialisée en polyculture élevage");
        $bien27->setDescription("Exploitation située dans le Sud Est de La Sarthe, entre la commune d\'Ecommoy (72220) et Sarc? (72327)");
        $bien27->setCp("72220");
        $bien27->setVille("Le Mans");
        $bien27->setIsLocatif("0");
        $bien27->setPrix("75000");
        $bien27->setSurface("87");
        $bien27->setRef("AA 72 22 0088 R");
        $bien27->setImage("AA 72 22 0088 R");
        $bien27->setIdCategorie($categEX);

        $bien28 = new Bien();
        $bien28->setTitre("Propriété Calvados");
        $bien28->setDescription("JFD : Noue de Sienne (14)");
        $bien28->setCp("17200");
        $bien28->setVille("Caen");
        $bien28->setIsLocatif("0");
        $bien28->setPrix("173440");
        $bien28->setSurface("17");
        $bien28->setRef("MQ14170356");
        $bien28->setImage("MQ14170356");
        $bien28->setIdCategorie($categEX);

        $bien29 = new Bien();
        $bien29->setTitre("Bois domainial");
        $bien29->setDescription("Bois accessible avec sentiers");
        $bien29->setCp("17200");
        $bien29->setVille("Nantes");
        $bien29->setIsLocatif("0");
        $bien29->setPrix("44110");
        $bien29->setSurface("32");
        $bien29->setRef("QDSGF56");
        $bien29->setImage("QDSGF56");
        $bien29->setIdCategorie($categBO);

        $bien30 = new Bien();
        $bien30->setTitre("Activités Equestres, Apiculture, Chasse");
        $bien30->setDescription("Propriété Charente-Maritime");
        $bien30->setCp("22700");
        $bien30->setVille("Lannion");
        $bien30->setIsLocatif("1");
        $bien30->setPrix("1000");
        $bien30->setSurface("35");
        $bien30->setRef("Z34.345.45");
        $bien30->setImage("Z34.345.45");
        $bien30->setIdCategorie($categPR);


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
