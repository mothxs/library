<?php

namespace Library\database\seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('partners')->insert([
            [
                'name' => 'Mikel',
                'surname' => 'Valhondo',
                'id_card' => '12345678p',
                'birth_date' => '1996-11-29',
                'address' => 'Dirreción 1',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Pablo',
                'surname' => 'Estribos',
                'id_card' => '12345677p',
                'birth_date' => '1992-11-29',
                'address' => 'Dirreción 2',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Mikel',
                'surname' => 'Valhondo',
                'id_card' => '12345675p',
                'birth_date' => '1991-11-29',
                'address' => 'Dirreción 3',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
