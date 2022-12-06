<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\type;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function search(){
        
        $movie = Movie::where('name','LIKE', '%'.$_GET['query'].'%')->get();
        $type = type::all();
       
        
        if ( $movie->count() != 0) {
            
            return view('movie_search',compact('movie','type'));
        }
        else{
            echo "<script>alert('Not Found')</script>";
            return redirect()->back();
        }
    }
    
    public function add(Request $request){
        //validate value
 
        $request->validate([
            'image' => 'required',
            'name' =>'required|max:200',
            'type' =>'required',
            'detail' =>'required'
        ]);
         //save value in database Eloquent
        $movie = new Movie;
        if (!$request->hasFile('image')) {
           dd("Don't has File");

        } else{
            $destiantion_path = '/storage/images/movie/';
            $image_name = $request->file('image')->getClientOriginalName();
           // $public = $request->file('image')->move(public_path('movie'),$image_name);
            $request->file('image')->storeAs($destiantion_path,$image_name);
            $request->image->move(public_path('storage/images/movie'), $image_name);
            $request->image = $image_name;
            
        }
        $movie->image = $request->image;
        $movie->name=$request->name;
        $movie->type_id=$request->type;
        $movie->detail=$request->detail;
        $movie->link_video=$request->link;
        $movie->rating=0;
        $movie->save();
        return redirect('movietable')->with('success','Save movie success');
    }
    public function edit(Request $request){
        //validate value
        $request->validate([
            'image' => '',
            'name' =>'max:200',
            'type' =>'',
            'detail' =>''
        ]);
         //save value in database Eloquent
        $movie = Movie::find($request->id);
       
        if (!$request->hasFile('image')) {
            $movie->image = $request->image;
        }
        else{
            $destiantion_path = '/storage/images/movie/';
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs($destiantion_path,$image_name);
            $request->image->move(public_path('storage/images/movie'), $image_name);
            $request->image = $image_name;
        } 
        
        $movie->image = $request->image;
        $movie->name=$request->name;
        $movie->type_id = $request->type;
        $movie->detail = $request->detail;
        $movie->link_video = $request->link;
        $movie->rating=0;
        $movie->save();
        return redirect('movietable')->with('success','Update moive success');
    }
    // public function displayImage($filename){
    //     $path = storage_public('images/' . $filename);
    //     if (!File::exists($path)) {
    //     abort(404);
    //     }

    //     $file = File::get($path);

    //     $type = File::mimeType($path);

  

    //     $response = Response::make($file, 200);

    //     $response->header("Content-Type", $type);

 

    //     return $response;
    // }


    public function delete(Request $request){
        //validate value
       
         //save value in database Eloquent
        $movie = Movie::find($request->id);
        
        $movie->delete();
        return redirect('movietable')->with('success','Delete movie success');
    }
    public function addtype(Request $request){
        //validate value
        $request->validate([
            'name' =>'required|max:200',
        ]);
         //save value in database Eloquent
        $type = new type;
        $type->name = $request->name;
        $type->save();
        return redirect()->back()->with('success','Save type success');
    }
    public function typeEdit(Request $request){
        //validate value
        $request->validate([
            'name' =>'max:200',
        ]);
        
         //save value in database Eloquent
        $type = type::find($request->id);
        $type->name=$request->name;
        $type->save();
        return redirect('typetable')->with('success','Edit type success');
    }
    public function typedelete(Request $request){
        //validate value
       
         //save value in database Eloquent
        $movie = type::find($request->id);
        
        if($movie->movie != null){
            return redirect('typetable')->with('notdel',"This type is not empty");
        }
        else{
            $movie->delete();
            return redirect('typetable')->with('success','Delete type success');
        }
        
        
    }
 
   
    
}
