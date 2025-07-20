<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute; // utile pour les casts personnalisés si besoin

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'function',
        'client_id',
        'last_login_at', // ✅ ajoute-le ici si tu veux pouvoir l’utiliser en mass-assignment
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ✅ cast automatique du champ en objet Carbon
    protected $dates = [
        'last_login_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
