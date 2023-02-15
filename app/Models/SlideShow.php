<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'title',
        'description',
        'image',
        'link',
        'image_link'
    ];
}
