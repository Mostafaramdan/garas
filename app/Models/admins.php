<?php

namespace App\Models;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Models\adminsTrait;


class admins extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, adminsTrait;

    protected $table = 'admins';
    protected $guarded = [] ;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected static function newFactory()
    {
        return AdminFactory::new();
    }
}
