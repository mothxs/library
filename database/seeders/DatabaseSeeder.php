<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Library\database\seeders\BookSeeder;
use Library\database\seeders\UserSeeder;
use Library\database\seeders\AuthorSeeder;
use Library\database\seeders\PartnerSeeder;
use Library\database\seeders\EditorialSeeder;
use Library\database\seeders\RentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AuthorSeeder::class,
            EditorialSeeder::class,
            PartnerSeeder::class,
            BookSeeder::class,
            RentSeeder::class,
            UserSeeder::class,
        ]);
    }
}
