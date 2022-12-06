<?php

namespace App\Http\Controllers;
use App\Models\likes;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function addLikes(Request $request){
       
        
        if($request->uid != ""){
            $userLike = likes::all()->where('user_id',$request->uid)->where('movie_id',$request->mid)->count();
       
        
            if($userLike > 0){
                $lid = 0;
                $userLikes = likes::where('user_id',$request->uid)->where('movie_id',$request->mid)->get();
                foreach($userLikes as $item){
                    $lid=$item->id;
                    
                }
                $likes = likes::find($lid);
                $likes->rating = (int)$request->rating;
                $likes->save();
                
                // /dd($likes->save());
            }
            else{
                $like = new likes;
                $like->rating = (int)$request->rating;
                $like->user_id=$request->uid;
                $like->movie_id=$request->mid;
                $like->save();
                
            }
            
            
            return redirect()->back()->with('success');
            }
        }
       
   

}
