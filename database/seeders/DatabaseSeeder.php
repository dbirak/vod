<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Films;
use App\Models\Genres;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::upsert(
            [
                [
                    'imie' => 'Jan',
                    'nazwisko' => 'Kowalski',
                    'email' => 'jankow@gmail.com',
                    'password' => Hash::make("kowal12@"),
                    'stan_konta' => '67.50',
                    'status' => 'user',
                ],
                [
                    'imie' => 'Michał',
                    'nazwisko' => 'Nowak',
                    'email' => 'nowaczek@gmail.com',
                    'password' => Hash::make("nowakmichal98."),
                    'stan_konta' => '23',
                    'status' => 'user',
                ],
                [
                    'imie' => 'Ewelina',
                    'nazwisko' => 'Karaś',
                    'email' => 'karas55@gmail.com',
                    'password' => Hash::make("ewela76#"),
                    'stan_konta' => '0',
                    'status' => 'user',
                ],
                [
                    'imie' => 'Zofia',
                    'nazwisko' => 'Rudnik',
                    'email' => 'ruda@interia.pl',
                    'password' => Hash::make("!@zofrud"),
                    'stan_konta' => '34',
                    'status' => 'user',
                ],
                [
                    'imie' => 'Dominik',
                    'nazwisko' => 'Birak',
                    'email' => 'dombir5@gmail.com',
                    'password' => Hash::make("admin2000."),
                    'stan_konta' => '0',
                    'status' => 'admin',
                ],
                [
                    'imie' => 'Kamil',
                    'nazwisko' => 'Dudek',
                    'email' => 'kamillo@onet.pl',
                    'password' => Hash::make("Dudeczek1995!"),
                    'stan_konta' => '0',
                    'status' => 'admin',
                ],
                [
                    'imie' => 'Michał',
                    'nazwisko' => 'Norek',
                    'email' => 'norek12@o2.pl',
                    'password' => Hash::make("Noreczek98."),
                    'stan_konta' => '0',
                    'status' => 'admin',
                ]
            ],
            'imie'
        );

        $this->call([
            GenresSeeder::class,
            FilmsSeeder::class,
            LoansSeeder::class,
        ]);
    }
}
