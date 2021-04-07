<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for ($i=1; $i < 11; $i++) {
            DB::table('products')->insert([
                'name' => 'Продукт_'.$i,
                'price' => rand(10, 50)
            ]);
        }
    }
}
