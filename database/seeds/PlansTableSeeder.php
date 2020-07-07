<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('plans')->insert([
            'name' => 'Principiante',
            'price' => '399',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,'
        ]);
        DB::table('plans')->insert([
            'name' => 'Avanzado',
            'price' => '449',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,'
        ]);
        DB::table('plans')->insert([
            'name' => 'Empresarial',
            'price' => '799',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,'
        ]);
    }
}
