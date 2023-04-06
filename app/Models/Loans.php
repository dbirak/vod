<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'films_id', 'data_zakonczenia'];

    public function films()
    {
        return $this->belongsTo(Films::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->belongsTo(Genres::class);
    }
}
