<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();
        $now = $now->format('c');
        \DB::table('categories')->insert(array('slug' => 'garage', 'strategy' => 'dateslot', 'name' => 'Garage',  'description' => 'Vehicle repair and services', 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL));
        \DB::table('categories')->insert(array('slug' => 'doctor', 'strategy' => 'dateslot', 'name' => 'Doctor',  'description' => 'Clinical Doctor', 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL));
        \DB::table('categories')->insert(array('slug' => 'photography', 'strategy' => 'dateslot', 'name' => 'Photographer',  'description' => 'Photographer', 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL));
    }
}
