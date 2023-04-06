<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Films;
use App\Models\Genres;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Genres::truncate();
        Schema::enableForeignKeyConstraints();
        Genres::upsert(
            [
                [
                    'kategoria' => 'Akcja',
                ],
                [
                    'kategoria' => 'Horror',
                ],
                [
                    'kategoria' => 'Fantasy',
                ],
                [
                    'kategoria' => 'Animowany',
                ],
                [
                    'kategoria' => 'Dreszczowiec',
                ],
                [
                    'kategoria' => 'Komedia',
                ],
                [
                    'kategoria' => 'Wojenny',
                ],
                [
                    'kategoria' => 'Przygodowy',
                ]
            ],
            'kategoria'
        );
    }
}
