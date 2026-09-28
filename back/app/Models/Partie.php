<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categorie_id',
        'score',
        'total',
    ];

    protected $casts = [
        'score' => 'integer',
        'total' => 'integer',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /** Nul lorsque la partie a été jouée sans compte. */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
