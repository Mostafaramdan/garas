<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breaks extends Model
{
    use HasFactory;

    protected $table = 'breaks';

    protected $fillable = ['after_class_room','time'];
}
