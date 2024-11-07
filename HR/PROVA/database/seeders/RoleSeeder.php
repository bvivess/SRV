<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'gestor',
            'registrat'
        ];

        foreach ($roles as $role) {
            $newrole = new Role();
            $newrole->name = $role;
            $newrole->save();
        }

    }
}
