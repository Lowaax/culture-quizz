<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        foreach (['Personnages', 'Planètes & Lieux', 'Vaisseaux & Technologie', 'La Force & les Jedi', 'Sagas & Films', 'Créatures & Espèces'] as $categorie) {
            Categorie::firstOrCreate(['categorie' => $categorie]);
        }
    }
}
