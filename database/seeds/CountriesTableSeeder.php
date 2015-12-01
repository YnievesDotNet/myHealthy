<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $now = new DateTime();
        $now = $now->format('c');
        \DB::table('countries')->insert(array('id_country' => '113', 'name' => 'Cuba', 'languaje_id' => '1', 'lat' => '21.5217571259', 'long' => '-77.7811660767', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('countries')->insert(array('id_country' => '113', 'name' => 'Cuba', 'languaje_id' => '2', 'lat' => '21.5217571259', 'long' => '-77.7811660767', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
    }
}
