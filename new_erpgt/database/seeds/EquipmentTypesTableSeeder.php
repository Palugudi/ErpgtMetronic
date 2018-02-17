<?php

use App\Models\Equipment_type;
use Illuminate\Database\Seeder;

class EquipmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Badgeuse';
        $equipmentType->domain_id = 1;
		$equipmentType->picture = "badgeuse.png";
        $equipmentType->maintenance = "Badgeuse.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'SAS';
		$equipmentType->domain_id = 2;
        $equipmentType->picture = "sas.png";
        $equipmentType->maintenance = "SAS.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Porte de garage';
        $equipmentType->domain_id = 2;
        $equipmentType->picture = "porte-de-garage.png";
        $equipmentType->maintenance = "Porte-de-garage.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Autre porte';
		$equipmentType->domain_id = 2;
        $equipmentType->picture = "autre-porte.png";
        $equipmentType->maintenance = "Autre-porte.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'VRV';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "vrv.png";
        $equipmentType->maintenance = "VRV.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Vanne chauffage';
        $equipmentType->domain_id = 3;
        $equipmentType->picture = "vanne-chauffage.png";
        $equipmentType->maintenance = "Vanne-chauffage.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Ventilation mécanique';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "ventilation-mecanique.png";
        $equipmentType->maintenance = "Ventilation-mecanique.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Cassette';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "cassette.png";
        $equipmentType->maintenance = "Cassette.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Split';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "split.png";
        $equipmentType->maintenance = "Split.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Chaudière';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "chaudiere.png";
        $equipmentType->maintenance = "Chaudiere.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Contrôle d\'étanchéïté';
        $equipmentType->domain_id = 3;
        $equipmentType->picture = "controle-d-etancheite.png";
        $equipmentType->maintenance = "Controle-d-etancheite.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Unité interieure';
		$equipmentType->domain_id = 3;
        $equipmentType->picture = "unite-interieure.png";
        $equipmentType->maintenance = "Unite-interieure.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'TGBT';
        $equipmentType->domain_id = 4;
        $equipmentType->picture = "electricity.png";
        $equipmentType->maintenance = "TGBT.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Déclencheur MX';
		$equipmentType->domain_id = 4;
        $equipmentType->picture = "declencheur-mx.png";
        $equipmentType->maintenance = "Declencheur-MX.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Arrêt d\'urgence';
        $equipmentType->domain_id = 4;
        $equipmentType->picture = "arret-d-urgence.png";
        $equipmentType->maintenance = "Arret-d-urgence.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Transformateur';
        $equipmentType->domain_id = 4;
        $equipmentType->picture = "transformateur.png";
        $equipmentType->maintenance = "Transformateur.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Tableau divisionnaire';
		$equipmentType->domain_id = 4;
        $equipmentType->picture = "tableau-divisionnaire.png";
        $equipmentType->maintenance = "Tableau-divisionnaire.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Poste EDF';
        $equipmentType->domain_id = 4;
        $equipmentType->picture = "poste-edf.png";
        $equipmentType->maintenance = "Poste-EDF.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Ascenseur';
		$equipmentType->domain_id = 5;
        $equipmentType->picture = "ascenseur.png";
        $equipmentType->maintenance = "Ascenseur.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Extincteurs';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "extincteurs.png";
        $equipmentType->maintenance = "Extincteurs.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'BAES';
        $equipmentType->domain_id = 6;
        $equipmentType->picture = "baes.png";
        $equipmentType->maintenance = "BAES.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'BAES Anti Panique';
        $equipmentType->domain_id = 6;
        $equipmentType->picture = "baes-anti-panique.png";
        $equipmentType->maintenance = "BAES-Anti-Panique.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Issue de secours';
        $equipmentType->domain_id = 6;
        $equipmentType->picture = "issue-de-secours.png";
        $equipmentType->maintenance = "Issue-de-secours.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Sortie de secours';
        $equipmentType->domain_id = 6;
        $equipmentType->picture = "sortie-de-secours.png";
        $equipmentType->maintenance = "Sortie-de-secours.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Déclencheur manuel';
        $equipmentType->domain_id = 6;
        $equipmentType->picture = "declencheur-manuel.png";
        $equipmentType->maintenance = "Declencheur-manuel.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Déclencheur porte manuel';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "declencheur-porte.png";
        $equipmentType->maintenance = "Declencheur-porte-manuel.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'SSI (Système de sécurité incendie)';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "ssi.png";
        $equipmentType->maintenance = "SSI.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Détecteur d\'incendie';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "detecteur-d-incendie.png";
        $equipmentType->maintenance = "Detecteur-d-incendie.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Détecteur de fumée autonome';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "detecteur-de-fumee-autonome.png";
        $equipmentType->maintenance = "Detecteur-de-fumee-autonome.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Alarme sonore Type 4';
		$equipmentType->domain_id = 6;
        $equipmentType->picture = "alarme-sonore-type-4.png";
        $equipmentType->maintenance = "Alarme-sonore-Type-4.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Éclairage normal';
		$equipmentType->domain_id = 7;
        $equipmentType->picture = "eclairage-normal.png";
        $equipmentType->maintenance = "Eclairage-normal.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Enseigne intérieure';
		$equipmentType->domain_id = 7;
        $equipmentType->picture = "lights.png";
        $equipmentType->maintenance = "Enseigne-interieure.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Enseigne extérieure';
		$equipmentType->domain_id = 7;
        $equipmentType->picture = "lights.png";
        $equipmentType->maintenance = "Enseigne-exterieure.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Ballon de stockage';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "ballon-de-stockage.png";
        $equipmentType->maintenance = "Ballon-de-stockage.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Disconnecteur';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "disconnecteur.png";
        $equipmentType->maintenance = "Disconnecteur.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Chauffe-eau';
        $equipmentType->domain_id = 8;
        $equipmentType->picture = "chauffe-eau.png";
        $equipmentType->maintenance = "Chauffe-eau.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Ballon d\'eau chaude';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "ballon-d-eau-chaude.png";
        $equipmentType->maintenance = "Ballon-d-eau-chaude.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Compteur d\'eau';
        $equipmentType->domain_id = 8;
        $equipmentType->picture = "compteur-d-eau.png";
        $equipmentType->maintenance = "Compteur-d-eau.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Surpresseur';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "surpresseur.png";
        $equipmentType->maintenance = "Surpresseur.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Circulateur, Pompe de circulation';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "circulateur-pompe-de-circulation.png";
        $equipmentType->maintenance = "Circulateur,-Pompe-de-circulation.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Pompe de relevage';
        $equipmentType->domain_id = 8;
        $equipmentType->picture = "pompe-de-relevage.png";
        $equipmentType->maintenance = "Pompe-de-relevage.pdf";
        $equipmentType->save();

        $equipmentType = new Equipment_type();
        $equipmentType->name = 'Vanne générale eau';
        $equipmentType->domain_id = 8;
        $equipmentType->picture = "vanne-generale-eau.png";
        $equipmentType->maintenance = "Vanne-generale-eau.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Vannes';
		$equipmentType->domain_id = 8;
        $equipmentType->picture = "vannes.png";
        $equipmentType->maintenance = "Vannes.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Caméra de surveillance';
		$equipmentType->domain_id = 9;
        $equipmentType->picture = "camera-de-surveillance.png";
        $equipmentType->maintenance = "Camera-de-surveillance.pdf";
        $equipmentType->save();

    	$equipmentType = new Equipment_type();
		$equipmentType->name = 'Local serveur';
		$equipmentType->domain_id = 10;
        $equipmentType->picture = "local-serveur.png";
        $equipmentType->maintenance = "";
        $equipmentType->save();
    }
}
