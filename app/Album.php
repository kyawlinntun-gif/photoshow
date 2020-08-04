<?php

namespace App;

use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
      'name', 'description', 'image_cover'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
