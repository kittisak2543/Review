<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\movie;
use App\Models\comment;
use App\Models\likes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller 
{
    
    public function movie(){

        $movies = Movie::all();
        $user = User::all();
        $likslike = array();
        $badmovielist = array();
        $topcommu = array();
        foreach($movies as $index=>$item){
            $alllike = 0;
            $likesmovie = 0;
            $badmovie = 0;
            if($movies != ""){
                foreach($user as $items){
            
                    $userment = $item->comments->where("user_id",$items->id)->count() ;
                    $userlike = $item->likes->where("user_id",$items->id)->count() ;
            
                    $userments = $item->comments->where("user_id",$items->id)->where('rating',1)->count() ;
                    $userlikes = $item->likes->where("user_id",$items->id)->where('rating',1)->count() ;
                    
                    $usermentsbad = $item->comments->where("user_id",$items->id)->where('rating',2)->count() ;
                    $userlikesbad = $item->likes->where("user_id",$items->id)->where('rating',2)->count() ;
                    


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
                    if($usermentsbad > 0){
                        $badmovie += $usermentsbad;
                    }else{
                        $badmovie += $userlikesbad;
                    }

                }
                $item->likeuser = $alllike;
                $item->likemovie = $likesmovie;
                //$point = $likesmovie - $badmovie ;
                if($item->likeuser != 0){
                    $item->badmovie = $badmovie ;
                }else{
                    $item->badmovie = 0;
                }
                

                $sub =0 ;

                $sub = ($item->likemovie * 100);
                $total_rating = 0;
                if($item->likeuser !=0){
                    $total_rating =   $sub /  $item->likeuser;
                }
                

                $subbad =0 ;

                $subbad = ($item->badmovie * 100);
                $total_ratingbad = 0;
                if($item->likeuser !=0){
                    $total_ratingbad =   $subbad /  $item->likeuser;
                }
                

                $badmovielist[$index]["bad"] = $total_ratingbad ;
                $badmovielist[$index]["id"] = $item->id;
                
                $likslike[$index]["like"] = $total_rating;
                $likslike[$index]["id"] = $item->id;

                $topcommu[$index]["totalpoint"] = $item->clicks()->count() + $item->likemovie+$item->badmovie;;
                $topcommu[$index]["goodpoint"] = $item->likemovie;
                $topcommu[$index]["all"] = $item->likeuser;
                $topcommu[$index]["total"] = $total_rating; 
                $topcommu[$index]["badpoint"] = $item->badmovie;
                $topcommu[$index]["viewpoint"] = $item->clicks()->count();
                $topcommu[$index]["id"] = $item->id;
                
            }
            
        
        
        }
        $topcommu2=[];
        rsort($topcommu);
        for($x = 0; $x < 6; $x++) {
            $topcommu2[$x] = $topcommu[$x];
        
        } 
        foreach($topcommu2 as $index=>$value){
            $movie[$index] = Movie::where("id",$value['id'])->get(); 
            
            
            
        
            
        }  
        $movieshow = array();
        foreach($movie as $index=>$item){
            foreach($item as $key=>$mValue){
                $movieshow[$index]["id"] = $mValue->id;
                $movieshow[$index]["name"] = $mValue->name;
                $movieshow[$index]["type_name"] = $mValue->type->name;
                $movieshow[$index]["image"] = $mValue->image;
                $movieshow[$index]["like"] = $mValue->likes->where("rating",1)->count();
                $movieshow[$index]["dislike"] = $mValue->likes->where("rating",2)->count();
                $movieshow[$index]["total_rating"] = number_format($topcommu2[$index]['total'],2);
                $movieshow[$index]["allComment"] = number_format($topcommu2[$index]['all'],2);
              
               
            }
        }
           
             
        return response()->json($movieshow);
    }
    public function recommend($id){
        $user = User::all();
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\AirecAll.py";
            $userid = $id;
            
            ob_start();
            passthru("python $path $userid");
            $output = preg_replace('~[\r\n]+~','', ob_get_clean());     
            //echo($output);
            //echo "<script>alert('$output')</script>";
            $recnew = explode(',',$output);
            $i = 0;
            foreach($recnew as $item){
                $rechome[$i++] = Movie::find($item);

            }
            foreach($rechome as $item){
                $alllike = 0;
                $likesmovie = 0;
                $total_rating = 0;
                if($item != ""){
                    foreach($user as $items){
                
                        $userment = $item->comments->where("user_id",$items->id)->count() ;
                        $userlike = $item->likes->where("user_id",$items->id)->count() ;
                
                        $userments = $item->comments->where("user_id",$items->id)->where('rating',1)->count() ;
                        $userlikes = $item->likes->where("user_id",$items->id)->where('rating',1)->count() ;
                        if($userment > 0){
                            $alllike += $userment;
                        }else{
                            $alllike += $userlike;
                        }
                        $sub =0 ;

                        
                        if($userments > 0){
                            $likesmovie += $userments;
                        }else{
                            $likesmovie += $userlikes;
                        }
                       }
                      
                        $item->likeuser = $alllike;
                        $item->likemovie = $likesmovie;
                        $sub = ($item->likemovie * 100);
                        
                        if($item->likeuser !=0){
                            $total_rating =   $sub /  $item->likeuser;
                        }
                        $item->total = $total_rating;
                
                }
               
            }
            
                foreach($rechome as $index=>$mValue){
                    $movieshow[$index]["id"] = $mValue->id;
                    $movieshow[$index]["name"] = $mValue->name;
                    $movieshow[$index]["type_name"] = $mValue->type->name;
                    $movieshow[$index]["image"] = $mValue->image;
                    $movieshow[$index]["like"] = $mValue->likes->where("rating",1)->count();
                    $movieshow[$index]["dislike"] = $mValue->likes->where("rating",2)->count();
                    $movieshow[$index]["total_rating"] = number_format($mValue->total,2);
                    $movieshow[$index]["allComment"] = number_format($mValue->likeuser,2);
                  
                   
                }
            
        return response()->json($movieshow);
    }

   
}