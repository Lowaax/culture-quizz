<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    /**
     * Hache systématiquement le mot de passe au moment de l'écriture : aucun
     * point d'entrée (API, seeder, tinker) ne peut en stocker un en clair.
     *
     * @param  string  $valeur
     * @return void
     */
    public function setPasswordAttribute($valeur)
    {
        if ($valeur === null || $valeur === '') {
            return;
        }

        // Un hash déjà calculé est conservé tel quel, sinon on le hacherait deux fois.
        $this->attributes['password'] = Hash::needsRehash($valeur)
            ? Hash::make($valeur)
            : $valeur;
    }

    public function parties()
    {
        return $this->hasMany(Partie::class);
    }
}
