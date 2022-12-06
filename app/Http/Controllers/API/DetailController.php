<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clicks;
use App\Models\comment;
use App\Models\likes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Movie;
use Egulias\EmailValidator\Warning\Comment as WarningComment;
use Illuminate\Support\Arr;

class DetailController extends Controller
{
    public function detail($Mid,$Uid){
        $movies = Movie::all();
        $movie = $movies->find($Mid);
        $like = likes::where("movie_id",$Mid)->where("rating",1)->count();
        $dislike = likes::where("movie_id",$Mid)->where("rating",2)->count();
        $movie->status = "0";
        $status = likes::where("movie_id",$Mid)->where("user_id",$Uid)->get();
        if($status != null){
            foreach($status as $item){
                $movie->status = $item->rating;
            }
        }
        
        //$movie->status = $status->rating;
        $movie->like = $like;
        $movie->dislike = $dislike;
        
        $click = new clicks();
        $click->user_id = $Uid;
        $click->movie_id = $Mid;
        $click->save();
           
         


       
      
        return response()->json($movie);

    }
    public function  predict($name) {
        
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\Airec.py";
        $moviename = $name;
        
        ob_start();
        passthru("python $path $moviename");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     
        //echo($output);
        //echo "<script>alert('$output')</script>";
        return $output;
        
    }
    public function recdetail($moviename){
        $rec = array();
        $recss = [];
        $rec = $this->predict($moviename);
        
         $recs = explode("/",$rec);
        $i = 0;
        
        if($recs != ""){
          foreach($recs as $index=>$item){
              $movieRec =  Movie::where('name','LIKE', '%'. trim($item) .'%')->get();
              if(count($movieRec) > 0 && count($movieRec) < 6){
                  $i++;
                  $recss[$index] = $movieRec; 
              
              }  
             
             
                
          }
       
           
        }
        foreach($recss as $index=>$item){
            foreach($item as $key=>$mValue){
                $movieshow[$index]["id"] = $mValue->id;
                
                $movieshow[$index]["image"] = $mValue->image;
               
              
               
            }
        }
        
           
         


       
      
        return response()->json($movieshow);

    }
    public function showcommentall($Mid,$Uid){
        
        $commentAll = comment::where([
            ['movie_id','=',$Mid],
            ['user_id','!=',$Uid]
            ])->get();
        $user = User::all();
        foreach($commentAll as $item){
            $userwhere = $user->find($item->user_id);
            $item->username = $userwhere->name ;
            $item->time = $item->created_at->diffForHumans();
            $item->userphoto = $userwhere->profile_photo_path;
        }
        
        

        return response()->json($commentAll);
    }
    public function showcommentMe($Mid,$Uid){
        
        $commentUser = comment::where([
            ['movie_id','=',$Mid],
            ['user_id','=',$Uid]
            ])->get();
        $user = User::all();
        foreach($commentUser as $item){
            $userwhere = $user->find($item->user_id);
            $item->username = $userwhere->name ;
            $item->time = $item->created_at->diffForHumans();
            $item->userphoto = $userwhere->profile_photo_path;
        }
        
 
        return response()->json($commentUser);
    }
     
}
