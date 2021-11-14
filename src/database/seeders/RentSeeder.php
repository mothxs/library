<?php

namespace Library\database\seeders;

use DateTime;
use DateInterval;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('rents')->insert([
            [
                'book_id' => '1',
                'partner_id' => '1',
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->add(new DateInterval('P5D'))->format('Y-m-d'),
                'qty' => '1',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
