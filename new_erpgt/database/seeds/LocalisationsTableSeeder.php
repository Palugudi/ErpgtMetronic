<?php

use App\Models\Localisation;
use Illuminate\Database\Seeder;

class LocalisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localisations = ['Circulations', 'Accueil', 'Local Serveur', 'Extérieur', 'Bureaux', 'Local Clim', 'WC Hommes', 'WC Femmes', 'Sur Enseigne', 'Entrée', 'Parking', 'Local Informatique', 'Local Technique', 'Terrasse', 'Trappe', 'Bureau Direction', 'Local Social', 'WC', 'Entrée int/ext', 'Plafond Entrée', 'Sous-plafond', 'Local Chaufferie', 'Sol', 'Entrée Principale'];

        foreach ($localisations as $key => $localisation) {
            $new_localisation = new Localisation();
            $new_localisation->name = $localisation;
            $new_localisation->save();
        }
    }
}
