<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->truncate();
        DB::table('products')->insert([
            'title' => 'Colaboracion del mes',
            'description' => 'Agosto',
            'image' => 'baseimage.png',
        ]);
        DB::table('products')->insert([
            'title' => 'Etiqueta del mes',
            'description' => 'Agosto',
            'image' => 'baseimage.png',
        ]);
        DB::table('products')->insert([
            'title' => 'Otra etiqueta',
            'description' => 'Julio',
            'image' => 'baseimage.png',
        ]);
    }
}
