<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'title',
        'content'
    ];

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
