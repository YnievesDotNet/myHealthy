<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
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
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1886', 'name' => 'Pinar del Rio', 'languaje_id' => '1', 'lat' => '22.5833320618', 'long' => '-83.6666641235', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1886', 'name' => 'Pinar del Rio', 'languaje_id' => '2', 'lat' => '22.5833320618', 'long' => '-83.6666641235', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1887', 'name' => 'Ciudad de la Habana', 'languaje_id' => '1', 'lat' => '23.1021461487', 'long' => '-82.3056335449', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1887', 'name' => 'Ciudad de la Habana', 'languaje_id' => '2', 'lat' => '23.1021461487', 'long' => '-82.3056335449', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1888', 'name' => 'Matanzas', 'languaje_id' => '2', 'lat' => '23.0499992371', 'long' => '-81.5833358765', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1888', 'name' => 'Matanzas', 'languaje_id' => '1', 'lat' => '23.0499992371', 'long' => '-81.5833358765', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1889', 'name' => 'Isla de la Juventud', 'languaje_id' => '1', 'lat' => '21.6684646606', 'long' => '-82.8769149780', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1889', 'name' => 'Isla de la Juventud', 'languaje_id' => '2', 'lat' => '21.6684646606', 'long' => '-82.8769149780', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1890', 'name' => 'Camaguey', 'languaje_id' => '1', 'lat' => '21.3859004974', 'long' => '-77.9135437012', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1890', 'name' => 'Camaguey', 'languaje_id' => '2', 'lat' => '21.3859004974', 'long' => '-77.9135437012', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1891', 'name' => 'Ciego de Avila', 'languaje_id' => '1', 'lat' => '21.8413505554', 'long' => '-78.7625503540', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1891', 'name' => 'Ciego de Avila', 'languaje_id' => '2', 'lat' => '21.8413505554', 'long' => '-78.7625503540', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1892', 'name' => 'Cienfuegos', 'languaje_id' => '2', 'lat' => '22.1499996185', 'long' => '-80.4499969482', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1892', 'name' => 'Cienfuegos', 'languaje_id' => '1', 'lat' => '22.1499996185', 'long' => '-80.4499969482', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1893', 'name' => 'Granma', 'languaje_id' => '1', 'lat' => '20.2500000000', 'long' => '-77.0000000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1893', 'name' => 'Granma', 'languaje_id' => '2', 'lat' => '20.2500000000', 'long' => '-77.0000000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1894', 'name' => 'Guantanamo', 'languaje_id' => '2', 'lat' => '20.1430301666', 'long' => '-75.2090072632', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1894', 'name' => 'Guantanamo', 'languaje_id' => '1', 'lat' => '20.1430301666', 'long' => '-75.2090072632', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1895', 'name' => 'La Habana', 'languaje_id' => '2', 'lat' => '23.1333332062', 'long' => '-82.3666687012', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1895', 'name' => 'La Habana', 'languaje_id' => '1', 'lat' => '23.1333332062', 'long' => '-82.3666687012', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1896', 'name' => 'Holguin', 'languaje_id' => '2', 'lat' => '20.8833332062', 'long' => '-76.2500000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1896', 'name' => 'Holguin', 'languaje_id' => '1', 'lat' => '20.8833332062', 'long' => '-76.2500000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1897', 'name' => 'Las Tunas', 'languaje_id' => '1', 'lat' => '20.9657993317', 'long' => '-76.9502334595', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1897', 'name' => 'Las Tunas', 'languaje_id' => '2', 'lat' => '20.9657993317', 'long' => '-76.9502334595', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1898', 'name' => 'Sancti Spiritus', 'languaje_id' => '2', 'lat' => '22.0000000000', 'long' => '-79.2500000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1898', 'name' => 'Sancti Spiritus', 'languaje_id' => '1', 'lat' => '22.0000000000', 'long' => '-79.2500000000', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1899', 'name' => 'Santiago de Cuba', 'languaje_id' => '2', 'lat' => '20.0166664124', 'long' => '-75.8166656494', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1899', 'name' => 'Santiago de Cuba', 'languaje_id' => '1', 'lat' => '20.0166664124', 'long' => '-75.8166656494', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1900', 'name' => 'Villa Clara', 'languaje_id' => '2', 'lat' => '22.5008239746', 'long' => '-80.0095901489', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('regions')->insert(array('id_country' => '113', 'id_region' => '1900', 'name' => 'Villa Clara', 'languaje_id' => '1', 'lat' => '22.5008239746', 'long' => '-80.0095901489', 'active' => '1', 'created_at' => $now, 'updated_at' => $now));
    }
}
