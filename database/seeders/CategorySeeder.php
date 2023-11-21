<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = new category();
        $category1->nombre="DESAYUNOS";
        $category1->save();

        $category2 = new category();
        $category2->nombre="ALMUERZOS";
        $category2->save();

        $category3 = new category();
        $category3->nombre="COMIDAS";
        $category3->save();
    }
}
