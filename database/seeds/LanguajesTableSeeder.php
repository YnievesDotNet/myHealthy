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
        \DB::table('languajes')->insert(array('code' => 'es_ES.utf8', 'name' => 'spanish', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('languajes')->insert(array('code' => 'en_US.utf8', 'name' => 'english', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
    }
}
