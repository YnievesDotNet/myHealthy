<?php

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
        ini_set('max_execution_time', 600);
        $notifynder = new NotifynderCategoriesSeeder;
        $notifynder->run();
        $categories = new CategoriesSeeder;
        $categories->run();
        $countries = new CountriesTableSeeder;
        $countries->run();
        $location = new LocationTableSeeder();
        $location->run();
        $roles = new RolesTableSeeder;
        $roles->run();
        $languajes = new LanguajesTableSeeder();
        $languajes->run();
    }
}
