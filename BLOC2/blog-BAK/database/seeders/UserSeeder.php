<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$adminUser = new User();
        $adminUser->name = "Tomeu";
        $adminUser->email = "bvivess@gmail.com";
        $adminUser->role = "superjefe";
        $adminUser->password = Hash::make('12345678');
        $adminUser->save();*/

        User::factory(5)->create();


    }
}
