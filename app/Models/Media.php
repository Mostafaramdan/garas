<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Media extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table   = 'medias';
    public $translatedAttributes = ['title', 'description'];

    /**
     * @var string[] mass assignment
     */
    protected $fillable = [
        'created_by','type', 'mediable_type', 'mediable_id', 'display_at', 'path'
    ];

    protected $append = ['file_path'];

    public function getFilePathAttribute(){
        $model = Str::plural( strtolower(class_basename($this->mediable_type)) );

        return $this->path != null ? asset('uploads/'.$model.'_medias/'.$this->path) :  null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function mediable() : MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return MediaFactory::new();
    }
}
