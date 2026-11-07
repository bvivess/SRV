<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'visitant'];

        foreach ($roles as $name) {
            Role::firstOrCreate([
                'name' => $name
            ]);
        }
    }
}
