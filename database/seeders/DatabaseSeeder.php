<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Initialisation des données de base (Rôles)
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Création des Écoles
        $this->call([
            EcoleSeeder::class,
        ]);

        $ecole = \App\Models\Ecole::first();
        if ($ecole) {
            // Fixe l'école active pour que les seeders suivants affectent les données à cette école
            \App\Tenant\TenantManager::setEcoleId($ecole->id);
        }

        // 3. Autres Seeders (dépendants de l'école active)
        $this->call([
            CycleSeeder::class,
            NiveauSeeder::class,
            ClasseSeeder::class,
            AnneeScolaireSeeder::class,
            ParentsSeeder::class,
            RelationSeeder::class,
            StudentSeeder::class,
            InscriptionSeeder::class,
            MatiereSeeder::class,
            EnseignantSeeder::class,
            AffectationPedagogiqueSeeder::class,
            PeriodeSeeder::class,
            EvaluationSeeder::class,
            JourSeeder::class,
            HoraireSeeder::class,
        ]);

        // 4. Créer un Super Administrateur (sans école, accès global)
        $superAdmin = \App\Models\User::firstOrCreate([
            'email' => 'superadmin@admin.com',
        ], [
            'name' => 'Super Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'ecole_id' => null,
        ]);
        $superAdmin->assignRole('Super Admin');

        // 5. Créer un utilisateur Administrateur d'école (lié à l'école de test)
        if ($ecole) {
            $admin = \App\Models\User::firstOrCreate([
                'email' => 'admin@admin.com',
            ], [
                'name' => 'Admin Test',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'ecole_id' => $ecole->id, // Important : lié à l'école
            ]);
            $admin->assignRole('admin');
        }
    }
}
