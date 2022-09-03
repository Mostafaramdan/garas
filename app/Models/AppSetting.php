<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AppSetting extends Model
{
    use HasFactory;
    protected $table = 'app_settings';
    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function medias() : MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
