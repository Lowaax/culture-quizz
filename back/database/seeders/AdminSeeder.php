<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Crée (ou remet à jour) le compte qui ouvre l'interface d'administration.
 * Le mot de passe n'est jamais écrit dans le code : il vient du fichier .env,
 * qui n'est pas suivi par Git.
 */
class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = env('ADMIN_EMAIL');
        $motDePasse = env('ADMIN_PASSWORD');

        if (!$email || !$motDePasse) {
            $this->command->error('ADMIN_EMAIL ou ADMIN_PASSWORD absent du .env : aucun administrateur créé.');
            return;
        }

        $admin = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Administrateur'),
                'password' => $motDePasse,
            ]
        );

        // is_admin n'est pas dans $fillable pour qu'aucune requête HTTP ne
        // puisse s'attribuer le drapeau : on l'écrit explicitement ici.
        $admin->is_admin = true;
        $admin->save();

        $this->command->info('Administrateur prêt : ' . $admin->email);
    }
}
