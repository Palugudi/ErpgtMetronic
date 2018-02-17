<?php

use App\Models\Document_type;
use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document_type = new Document_type();
        $document_type->name = 'Dossier d\'ouvrage éxécutif (DOE)';
        $document_type->picture = 'doe.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Devis en cours';
        $document_type->picture = 'dec.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'PV';
        $document_type->picture = 'pv.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Permis de travail en hauteur';
        $document_type->picture = 'pth.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Relevé de réserves';
        $document_type->picture = 'rdr.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Relevé de compteur';
        $document_type->picture = 'rdc.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Environnement, Hygiène et sécurité (EHS)';
        $document_type->picture = 'ehs.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Références produits';
        $document_type->picture = 'rp.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Contrôle d\'étanchéité';
        $document_type->picture = 'cde.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Gestion éclairage';
        $document_type->picture = 'ge.png';
        $document_type->save();

        $document_type = new Document_type();
        $document_type->name = 'Planning Annuel';
        $document_type->picture = 'pa.png';
        $document_type->save();
    }
}
