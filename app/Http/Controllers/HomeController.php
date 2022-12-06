<?php

namespace App\Http\Controllers;

use App\Models\clicks;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Movie;
use App\Models\comment;
use App\Models\likes;
use App\Models\type;
use App\Models\User;
use Egulias\EmailValidator\Warning\Comment as WarningComment;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends Controller
{
    public function  predictrec() {
        
        if(Auth::user() != null){
            $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\AirecAll.py";
            $userid = Auth::user()->id;
            
            ob_start();
            passthru("python $path $userid");
            $output = preg_replace('~[\r\n]+~','', ob_get_clean());     
            //echo($output);
            //echo "<script>alert('$output')</script>";
           
            $recnew = explode(',',$output);
            return $recnew;
        }
        
    }
    public function redirects(){
        $role = Auth::user()->role;
        $movies = Movie::paginate(6);
        $moviea = Movie::all();
        $user = Auth::user();
        $type= type::all();
        $users = User::all();
        $allUser = User::all()->count();
        $allComment = comment::all()->count();
        $allMovie = Movie::all()->count();
        $recall = $this->predictrec();
        foreach($movies as $item){
            $alllike = 0;
            $likesmovie = 0;
            if($movies != ""){
                foreach($users as $items){
            
                    $userment = $item->comments->where("user_id",$items->id)->count() ;
                    $userlike = $item->likes->where("user_id",$items->id)->count() ;
            
                    $userments = $item->comments->where("user_id",$items->id)->where('rating',1)->count() ;
                    $userlikes = $item->likes->where("user_id",$items->id)->where('rating',1)->count() ;
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
                   }
                  $item->likeuser = $alllike;
                  $item->likemovie = $likesmovie;
            }
           
           
        }
        
       
        
        $rechome = array();
        $i = 0;
        foreach($recall as $item){
            $rechome[$i++] = Movie::find($item);

        }
       
     
   
    
    $likslike = array();
    $badmovielist = array();
    $topcommu = array();
    foreach($moviea as $index=>$item){
        $alllike = 0;
        $likesmovie = 0;
        $badmovie = 0;
        if($moviea != ""){
            foreach($users as $items){
        
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
              $badmovielist[$index]["like"] = $total_rating;
              $badmovielist[$index]["id"] = $item->id;
              
              $likslike[$index]["like"] = $total_rating;
              $likslike[$index]["bad"] = $total_ratingbad ;
              $likslike[$index]["id"] = $item->id;

              $topcommu[$index]["totalpoint"] = $item->clicks()->count() + $item->likemovie+$item->badmovie;;
              $topcommu[$index]["goodpoint"] = $item->likemovie;
              $topcommu[$index]["badpoint"] = $item->badmovie;
              $topcommu[$index]["all"] = $item->likeuser;
              $topcommu[$index]["viewpoint"] = $item->clicks()->count();
              $topcommu[$index]["id"] = $item->id;
              

             
        }
        
       
       
    }
   
    $likslike2 = array();
    $badmovielist2 = array();
    $topcommu2 = array();
    rsort($badmovielist);
    for($x = 0; $x <= 9; $x++) {
        $badmovielist2[$x] = $badmovielist[$x];
       
      }
      rsort($likslike);
    for($x = 0; $x <= 9; $x++) {
        $likslike2[$x] = $likslike[$x];
       
      }
      rsort($topcommu);
      for($x = 0; $x <= 5; $x++) {
        $topcommu2[$x] = $topcommu[$x];
       
      }
    
      $goodmovie = [];
    
      foreach($likslike2 as $index=>$item){
       
        $searchmovie[$index] = Movie::where('id',$item['id'])->get();
       
        
      }
      foreach($badmovielist2 as $index=>$item){
       
        $searchmoviebad[$index] = Movie::where('id',$item['id'])->get();
       
        
      }
      foreach($topcommu2 as $index=>$item){
       
        $searchmoviebadCommu[$index] = Movie::where('id',$item['id'])->get();
       
      }
     
    
      //dd($searchmovie);
        $topcommulist[0] = ["moviename","Good Review","Bad Review","View times","Total Point"];
        $goodmovie[0] = ["moviename",'Good Rating Percent' , "Bad Rating Percent"];
        $badmovieshow[0] = ["moviename",'Good Rating Percent' ,"Bad Rating Percent"];
        $goodMovieList = array();
       foreach($searchmovie as $index=>$item){
        foreach($item as $indexs=>$items){
            $goodmovie[$index+1] = [$items->name,$likslike2[$index]["like"],$likslike2[$index]["bad"]];
            
            
        }
        
        
      }
      
      foreach($searchmoviebad as $index=>$item){
        foreach($item as $indexs=>$items){
            $badmovieshow[$index+1] = [$items->name,$badmovielist2[$index]["like"],$badmovielist2[$index]["bad"]];
        }
      }

      foreach($searchmoviebadCommu as $index=>$item){
        foreach($item as $indexs=>$items){
            $topcommulist[$index+1] = [$items->name,$topcommu2[$index]["goodpoint"],$topcommu2[$index]["badpoint"],$topcommu2[$index]["viewpoint"],$topcommu2[$index]["totalpoint"]];
        }
      }

      foreach($topcommu2 as $index=>$value){
        $movie[$index] = Movie::where("id",$value['id'])->get(); 
        
        
        
       
        
    }  
    foreach($movie as $item){
        foreach($item as $key=>$mValue){
            
             $mValue->likemovie = $topcommu2[$key]['goodpoint'];
             $mValue->likeuser =  $topcommu2[$key]['all'];
        }
    }
      
    
    //   die();
      
    
        

        if($role == '1'){
            return view('admin/dashboard')->with(compact('user','allUser','allComment','allMovie','topcommu','goodmovie','badmovieshow','topcommulist') );
        }
        else{
            return view('welcome')->with(compact('user','role','movies','movie','type','rechome'));
        }
           
       
    }
    public function AUview(){
        $role = Auth::user()->role;

        $user = Auth::user();
        $movie = Movie::all();
    
        $likslike = array();
        $badmovielist = array();
        $topcommu = array();
        $users = User::all();
        foreach($movie as $index=>$item){
            $alllike = 0;
            $likesmovie = 0;
            $badmovie = 0;
            if($movie != ""){
                foreach($users as $items){
            
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

                $topcommu[$index]["point"] = $item->likeuser;
                $topcommu[$index]["id"] = $item->id;
                

                
            }
            
        
        
        }
        $likslike2 = array();
        $badmovielist2 = array();
        $topcommu2 = array();
        rsort($badmovielist);
        for($x = 0; $x < 9; $x++) {
            $badmovielist2[$x] = $badmovielist[$x];
        
        }
        rsort($likslike);
        for($x = 0; $x < 9; $x++) {
            $likslike2[$x] = $likslike[$x];
        
        }
        rsort($topcommu);
        for($x = 0; $x < 9; $x++) {
            $topcommu2[$x] = $topcommu[$x];
        
        }
        
      
        if($role == '1'){
            return view('admin/dashboard')->with(compact('user'));
        }
        else{
            return view('profile/show')->with(compact('user'));
        }
           
       
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
    public function passValue($id){
          $moviesel = Movie::find($id);
          $moviesearch = Movie::where('id',$id)->get();
          $moviename = "";
          foreach($moviesearch as $item){
            $moviename = $item->name;
          }

         if(Auth::user() != null){
            $click = new clicks();
            $click->user_id = Auth::user()->id;
            $click->movie_id = $id;
            $click->save();
         }
        $status = "";
        //  if(Auth::user() !=null){
        //     $checkcomment  = comment::where("movie_id",$id)->where("user_id",Auth::user()->id)->get();
        //     $status = count($checkcomment) > 0 ? "disabled":"";
        //  }
         
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
        
          
          
        
          
          $type = type::all();

          return view('movie-detail',['moviesel' => $moviesel,'type' => $type,'rec'=>$recss,'status'=>$status]);
          
    }


    public function passValueMovie($id){
        $movie = Movie::find($id);
        $type = type::all();
        return view('admin/movie-form',['movie'=> $movie,'type'=>$type]);
        
    } 
    
    public function passValueType($id){
        $type = type::find($id);
       
        return view('admin/type-form',['type'=>$type]);
        
    } 
    public function categories($type_id){
        $movie = Movie::where('type_id',$type_id)->get();
        $user = User::all();
        foreach($movie as $item){
            $alllike = 0;
            $likesmovie = 0;
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
    
            if($userments > 0){
                $likesmovie += $userments;
            }else{
                $likesmovie += $userlikes;
            }
           }
          $item->likeuser = $alllike;
          $item->likemovie = $likesmovie;
           
        }
        $typea = type::where('id',$type_id)->get();
        $type = type::all();

      
        return view('categoriesel',['movie'=> $movie,'typea'=> $typea ,'type' => $type, 'typeid' => $type_id]); 
    }
    public function comDel( Request $req){
        $comment = comment::where('id',$req->id);
  
        $comment->delete();

      
        return  redirect()->back()->with('success','Delete comment success');;
    }
    public function ViewCom($id){
        $comment = comment::where('movie_id',$id)->get();
        // $commen =$comment->paginate(10);
        $type = type::all();
      
        return view('admin/view-comment',['comment'=>$comment,'type' => $type]); 
    }
    


    
    
   
    
}
