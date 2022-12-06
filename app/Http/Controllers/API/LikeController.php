<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\movie;
use App\Models\comment;
use App\Models\likes;
use App\Models\User;

class LikeController extends Controller 
{
    
    public function like($mid){

        $like = likes::all()->where("movie_id",$mid)->where("rating",1)->count();
        $dislike = likes::all()->where("movie_id",$mid)->where("rating",2)->count();

        $filling = [];
        $filling["like"] =  $like;
        $filling["dislike"] = $dislike;

        return response()->json($filling);
    }
    public function addFilling(Request $request){
        $like = new likes;
          
            
            
           
        $like->rating = (int)$request->rating;
        $like->user_id=$request->uid;
        $like->movie_id=$request->mid;
        $like->save();

        return response()->json(array("message"=>"Thank you for your comments." , "status"=>"true"));
    }
    public function editFilling(Request $request){
        $L_id = "";
        $like = likes::where("user_id",$request->uid)->where("movie_id" ,$request->mid)->get();
        foreach($like as $item){
            $L_id = $item->id;
        }
        $likeup = likes::find($L_id);

           
        $likeup->rating = (int)$request->rating;
        $likeup->save();
       
        //return response()->json($likeup);
         return response()->json(array("message"=>"Thank you for your comments." , "status"=>"true"));
    }


   
}