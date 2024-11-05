<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->title = "Noves tecnologies";
        $category->url_clean = "noves_tecnologies";
        $category->save();

        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\categories.json');
        $categories = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($categories['categories']['category'] as $c) {
            Category::create([
                'title'     => $c['Nom'],
                'url_clean' => $c['url'],
            ]);
        }

    }
}