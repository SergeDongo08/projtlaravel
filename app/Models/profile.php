<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class profile extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'secondName',
        'email',
        'gender',
        'fonction',
        'number',
        'image',
        'password',
    ];
}
