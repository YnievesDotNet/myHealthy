<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
        \DB::table('roles')->insert(array('slug' => 'root', 'name' => 'Root', 'description' => 'System administration only', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('roles')->insert(array('slug' => 'manager', 'name' => 'Manager', 'description' => 'Business manager', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('roles')->insert(array('slug' => 'collaborator', 'name' => 'Collaborator', 'description' => 'Business manager with restricted access', 'created_at' => $now, 'updated_at' => $now));
        \DB::table('roles')->insert(array('slug' => 'user', 'name' => 'User', 'description' => 'Business customer/user', 'created_at' => $now, 'updated_at' => $now));
    }
}
