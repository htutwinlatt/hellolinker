<?php

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

if (!function_exists('get_user_country')) {
    function get_user_country(){
        $location_info = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        logger($location_info);
        return $location_info['geoplugin_countryName'];
    };
}

if(!function_exists('getMovieRating')){
    function getMovieRating($id){
        $comments = Comment::select('movie_id', DB::raw('SUM(rating) as total_rating'))->groupBy('movie_id')->where('movie_id', $id)->first();
        $comments_count = Comment::where('movie_id', $id)->count();
        if ($comments) {
            return $comments->total_rating / $comments_count;
        } else {
            return 4;
        }
    }
}
?>
