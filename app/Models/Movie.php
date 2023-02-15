<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['name',
    'description',
    'link',
    'image',
    'trailer',
    'actors',
    'studio',
    'director',
    'type',
    'episodes',
    'role',
    'view_count',
    'new_arrived',
    'image_link',
    'download_count',
    'released_at'];

    public static function search($db,$key)
    {
         $db->Where('name','like','%'.$key.'%')
            ->orWhere('actors','like','%'.$key.'%')
            ->orWhere('studio','like','%'.$key.'%')
            ->orWhere('director','like','%'.$key.'%')
            ->orWhere('type','like','%'.$key.'%')
            ->orWhere('description','like','%'.$key.'%')
            ;
    }

    public static function rating($movId){
        $comments = Comment::where('movie_id',$movId)->get();
        $rating = 0;
        for ($i=0; $i < count($comments) ; $i++) {
            $rating += $comments[$i]->rating;
        }

        if (count($comments) == 0) {
            return 0;
        }else{
           return round($rating/count($comments),1);
        }



    }
}


