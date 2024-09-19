<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'ENTRADAS',
            'CARNES',
            'PECHUGAS',
            'TRUCHAS',
            'SANDWICHES',
            'HAMBURGUESAS',
            'PASABOCAS',
            'MENU INFANTIL',
            'BEBIDAS CALIENTES',
            'GASEOSAS',
            'POSTRES',
            'BEBIDAS FRIAS',
            'CERVEZAS',
            'LICORES',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'id' => Str::uuid(),
                'name' => $category
            ]);
        }
    }
}
