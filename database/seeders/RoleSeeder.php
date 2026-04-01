<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        if (\Spatie\Permission\Models\Role::count() > 0) {
            return;
        }

        $roles = [
            'admin',
            'enseignant',
            'etudiant',
            'parent',
            'staff',
        ];

        foreach ($roles as $name) {
            \Spatie\Permission\Models\Role::create([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }
    }
}

