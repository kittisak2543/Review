<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
use App\Models\likes;
use App\Models\Movie;
use App\Models\type;

class CommentController extends Controller
{
    public function predict( $name){
        
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\Airec.py";
        $moviename = $name;
        
        ob_start();
        passthru("python $path $moviename");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     
        var_dump($output);
        //echo "<script>alert('$output')</script>";
       
        
    }
    public function addComment(Request $request){
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\Ai.py";
        $rcomment = $request->comment;

        // $like = likes::where("user_id",$request->uid)->where("movie_id",$request->mid)->get();

        // if(count($like) > 0){
        //     foreach($like as $item){
        //         $item->delete();
        //     }
        // }

        ob_start();
        passthru("python $path $rcomment");
        $output = preg_replace('~[\r\n]+~','', ob_get_clean());     

        
       
        //validate value
        
        $request->validate([
            'comment' => 'required',
        ]);
         //save value in database Eloquent
        $comment = new comment;
        if($request->uid == null){
            return redirect('login');
        }
        
        
        $comment->detail = $request->comment;
        $comment->rating = $output;
        $comment->user_id=$request->uid;
        $comment->movie_id=$request->mid;
        $comment->save();
        return redirect()->back()->with('success','Save comment success');
    }
    
}
