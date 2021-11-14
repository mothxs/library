<?php

namespace Library\database\seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();

        DB::table('books')->insert([
            [
                'title' => 'Crimen y castigo',
                'isbn' => '9781484087480',
                'pages' => '442',
                'qty' => '200',
                'author_id' => '1',
                'editorial_id' => '1',
                'category' => 'Thriller',
                'cover_type' => 'Blanda',
                'copyright' => 'Todos los derechos reservados',
                'publishing_place' => 'Rusia',
                'release_date' => '1866-10-03',
                'image' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => '100 años de soledad',
                'isbn' => '9780060114183',
                'pages' => '401',
                'qty' => '150',
                'author_id' => '2',
                'editorial_id' => '2',
                'category' => 'Realismo magico',
                'cover_type' => 'Dura',
                'copyright' => 'Todos los derechos reservados',
                'publishing_place' => 'México',
                'release_date' => '1967-11-23',
                'image' => '',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Sonata de primavera',
                'isbn' => '9788420600697',
                'pages' => '192',
                'qty' => '300',
                'author_id' => '3',
                'editorial_id' => '3',
                'category' => 'Novela literaria',
                'cover_type' => 'Blanda',
                'copyright' => 'Todos los derechos reservados',
                'publishing_place' => 'España',
                'release_date' => '1920-03-24',
                'image' => '',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
