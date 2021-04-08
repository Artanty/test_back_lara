<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;



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
                'price' => rand(10, 50),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
