<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['type',
        'remark',
        'movie_id'];

    public function movie()
    {
        return $this->hasOne(Movie::class,'id','movie_id');
    }
}
