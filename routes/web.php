<?php

use Illuminate\Support\Facades\Route;


use App\Models\User;
use App\Models\Movie;
use App\Models\type;
use App\Models\contact;
use App\Models\likes;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\LikeController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
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
    foreach($movie as $index=>$item){
        foreach($item as $key=>$mValue){
            
             $mValue->likemovie = $topcommu2[$index]['goodpoint'];
             $mValue->likeuser =  $topcommu2[$index]['all'];
        }
    }
    
   
    
    
    
    $type = type::all();
    $rechome = array();
    if(Auth::user() !=null){
        $path = "C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\AirecAll.py";
            $userid = Auth::user()->id;
            
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
           
           
            // if(count($rechome) == 0 ){
            //     $rechome = "null";
            // }
           
    }
    return view('welcome',compact('movie','type','rechome'));
});
Route::get('movie_search', function () {
   
    $type = type::all();
    
    return view('movie_search',compact('type'));
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    return view('profile/show');
})->name('dashboard');


Route::get('edit/{id}', [HomeController::class, 'passValueMovie'] );

Route::get('delete/{id}', [MovieController::class, 'delete'] );

Route::get('delete/message/{id}', [ContactController::class, 'delete'] );

Route::get('type_delete/{id}', [MovieController::class, 'typedelete'] );

Route::get('type_edit/{id}', [HomeController::class, 'passValueType'] );

Route::get('categories/{type_id}', [HomeController::class, 'categories'] );

Route::get('CommentDelete/{id}', [HomeController::class, 'comDel'] );

Route::get('ViewComment/{id}', [HomeController::class, 'ViewCom'] );

Route::get('account_delete/{id}', [ManageController::class, 'AccountDel'] );


Route::get('categorie', function () {
    $movie = movie::all();
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
    $type = type::all();
    return view('categorie',compact('movie','type'));
})->name('cat');

Route::get('Login', function () {
    $type = type::all();
    return view('auth/login',compact('type'));
})->name('logint');

Route::get('regis', function () {
    $type = type::all();
    return view('auth/register',compact('type'));
})->name('registert');

Route::get('/contact', function () {
    $type = type::all();
    return view('contact',compact('type'));
})->name('Contact');

Route::get('detail/{id}', [HomeController::class, 'passValue'] );

Route::post('contact', [ContactController::class, 'contact'])->name('Contact');

Route::get('/search', [MovieController::class, 'search'])->name('search');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    
   

    Route::get('auview', [HomeController::class, 'AUview']);

    Route::post('movie/add', [MovieController::class, 'add'])->name('Add-Movie');

    Route::post('movie/edit', [MovieController::class, 'edit'])->name('Edit-Movie');

    Route::post('movie/delete', [MovieController::class, 'delete'])->name('Delete-Movie');

    Route::post('type/add', [MovieController::class, 'addtype'])->name('Add-Type');

    Route::post('type/edit', [MovieController::class, 'typeEdit'])->name('Edit-Type');

    Route::post('comment/add', [CommentController::class, 'addComment'])->name('AddComment');

    Route::get('recommend/{name}', [CommentController::class, 'predict'])->name('predict');

    Route::post('like/add', [LikeController::class, 'addLikes'])->name('addLikes');

    Route::get('redirects', [HomeController::class, 'redirects']);

    Route::get('typetable', function () {
        $type = type::paginate(10);
        return view('admin/table-type',compact('type'));
    })->name('typetable');

    Route::get('usertable', function () {
        $user = User::paginate(10);
        return view('admin/table-account',compact('user'));
    })->name('usertable');

    Route::get('message', function () {
        $message = contact::paginate(10);
        return view('admin/contact_message',compact('message'));
    })->name('Message');

   

    Route::get('movietable', function () {
        $type = type::all();
        $user = User::all();
        $movie = Movie::paginate(5);
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
        return view('admin/table-movie',compact('movie','type'));
    })->name('movietable');

    Route::get('movie-form', function () {
        $type = type::all();
        return view('admin/movie-form',compact('type'));
    })->name('MovieForm');

    Route::post('predict', [CommentController::class, 'predict'])->name('houseprice.predict');
});




