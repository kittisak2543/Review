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
use phpDocumentor\Reflection\Types\Void_;

class CommentController extends Controller
{
    public function index(){
        $Movie = Movie::limit(5)->get();

        

        return response()->json($Movie);
    }
    public function addComment(Request $request){
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\Ai.py";
        $rcomment = $request->comment;

        ob_start();
        passthru("python $path $rcomment");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     

        
       
        //validate value
        
        $request->validate([
            'comment' => 'required',
        ]);
         //save value in database Eloquent
        $comment = new comment();
        if($request->uid == null){
            return response()->json(array('message'=>"Please login.",
        'status'=>'false'));
        }
        
        
        $comment->detail = $request->comment;
        $comment->rating = $output;
        $comment->user_id=$request->uid;
        $comment->movie_id=$request->mid;
        $comment->save();
        
        return response()->json(array('message'=>"Comment success.",
        'status'=>'true'));
    }
    public function deleteComment($id){
        $comment = comment::where('id',$id);
  
        $comment->delete();

        return response()->json(array('message'=>"Delete comment success.",
        'status'=>'true'));
    }
     
}
