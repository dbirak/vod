<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    use HasFactory;

    protected $fillable = ['tytul', 'rezyser', 'genres_id', 'produkcja', 'rok_produkcji', 'czas_trwania', 'ocena', 'opis', 'link_grafika', 'link_film', 'cena'];

    public function loans()
    {
        return $this->hasMany(Loans::class);
    }

    public function genres()
    {
        return $this->belongsTo(Genres::class);
    }
}
