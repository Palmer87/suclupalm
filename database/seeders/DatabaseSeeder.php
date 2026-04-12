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
        // 1. Toujours exécuter les données système essentielles
        $this->call([
            SystemSeeder::class,
        ]);

        // 2. Initialiser le TenantManager pour les données de test (si une école existe)
        $ecole = \App\Models\Ecole::first();
        if ($ecole) {
            \App\Tenant\TenantManager::setEcoleId($ecole->id);
        }

        // 3. Exécuter les données de test uniquement en local ou si spécifié
        if (config('app.env') !== 'production' || env('SEED_TEST_DATA', false)) {
            $this->command->info('Seeding test data...');
            
            $this->call([
                ClasseSeeder::class,
                ParentsSeeder::class,
                RelationSeeder::class,
                StudentSeeder::class,
                InscriptionSeeder::class,
                EnseignantSeeder::class,
                AffectationPedagogiqueSeeder::class,
                PeriodeSeeder::class,
                EvaluationSeeder::class,
            ]);
        }
    }
}
