<?php

use Illuminate\Database\Seeder;

class LanguajesTableSeeder extends Seeder
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
        \DB::table('languajes')->insert(array('code' => 'es', 'name' => 'spanish', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('languajes')->insert(array('code' => 'en', 'name' => 'english', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
    }
}
