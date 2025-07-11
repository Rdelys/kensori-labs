<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'company', 'email', 'phone', 'status',
    ];

    protected $hidden = ['password'];

    
    public function subscriptions()
{
    return $this->hasMany(Subscription::class);
}
}

