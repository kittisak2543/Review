<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Arr;

class MovieDetailController extends Controller
{
    public function movieDetail($Mid){
        $movie = Movie::all();
        $movie = $movie->find($Mid);
        foreach($movie as $item){
            $movie->like = $item->like->where("rating",1)->count();
        }
        return response()->json($movie);

    }
    public function comment($movie_id){
        $comment = comment::where('movie_id',"$movie_id")->where('user_id',"1")->get();

        return response()->json($comment);
    }
     
}
