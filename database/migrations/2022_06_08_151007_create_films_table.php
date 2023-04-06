<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Genres;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('tytul',50);
            $table->string('rezyser',50);
            $table->foreignIdFor(Genres::class)->constrained();
            $table->string('produkcja',50);
            $table->integer('rok_produkcji');
            $table->integer('czas_trwania');
            $table->decimal('ocena');
            $table->string('opis',510);
            $table->string('link_grafika',50);
            $table->string('link_film',50);
            $table->decimal('cena');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
