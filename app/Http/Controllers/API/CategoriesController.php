<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\movie;
use App\Models\comment;
use App\Models\likes;
use App\Models\type;
use App\Models\User;
use Illuminate\Support\ItemNotFoundException;
use Nette\Utils\ArrayList;
use phpDocumentor\Reflection\Element;

class CategoriesController extends Controller 
{
    
    public function categories($typename){
    
        $type = type::all();
        $type_name = array();
        $type_search = type::where('name',$typename)->get();
       
        
        
        if($type_search->count() > 0){
            foreach($type_search as $key=>$value){
                $type_name[$key]["name"] = $value->name;
            }
            return response()->json($type_name);
        }
        else{
            foreach($type as $key=>$value){
                $type_name[$key]["name"] = $value->name;
            }
            return response()->json($type_name);
        }
    }
    public function categoriesMovie($typename){
        $total_rating = 0;
        $user = User::all();
        $like = likes::where("rating",1)->get();
        $dislike = likes::where("rating",2)->get();
        $movieSearch = array();
        $type = type::where("name",$typename)->get();
        foreach($type as $index=>$value){
            
            $movies = Movie::where('type_id',$value->id)->get();
            foreach($movies as $index=>$value){
                $alllike = 0;
                $likesmovie = 0;
                $badmovie = 0;
                $total_rating = 0;
                foreach($user as $items){
                $total_rating = 0;
                $value->type_name = $value->type->name;
                $userment = $value->comments->where("user_id",$items->id)->count() ;
                $userlike = $value->likes->where("user_id",$items->id)->count() ;
            
                $userments = $value->comments->where("user_id",$items->id)->where('rating',1)->count() ;
                $userlikes = $value->likes->where("user_id",$items->id)->where('rating',1)->count() ;

                if($userment > 0){
                    $alllike += $userment;
                }else{
                    $alllike += $userlike;
                }
        
                if($userments > 0){
                    $likesmovie += $userments;
                }else{
                    $likesmovie += $userlikes;
                }
                $value->likeuser = $alllike;
                $value->likemovie = $likesmovie;
                $sub =0 ;

                $sub = ($value->likemovie * 100);
                
                if($value->likeuser !=0){
                    $total_rating =   $sub /  $value->likeuser;
                }

                $value->total_rating = number_format($total_rating,2); 
                $value->allComment = $value->likeuser;
                }
            
            }
            $movieshow = array();
            foreach($movies as $index=>$item){
                $movieshow[$index]["id"] = $item->id;
                $movieshow[$index]["name"] = $item->name;
                $movieshow[$index]["type_name"] = $item->type->name;
                $movieshow[$index]["image"] = $item->image;
                $movieshow[$index]["like"] = $item->likes->where("rating",1)->count();
                $movieshow[$index]["dislike"] = $item->likes->where("rating",2)->count();
                $movieshow[$index]["total_rating"] = number_format($item->total_rating,2);
                $movieshow[$index]["allComment"] = number_format($item->allComment,2);

            } 
            
        }
        return response()->json($movieshow);
            
        
        
        
    }
    public function type(){
        $type = type::all();
        $type_name = array();
        foreach($type as $key=>$item){
            $type_name[$key]["name"] = $item->name;
        }
        return response()->json($type_name);
    }

   
}