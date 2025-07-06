<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'name', 'function', 'email', 'password'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
