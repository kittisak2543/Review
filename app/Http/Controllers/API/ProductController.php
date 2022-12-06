<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function index(){
        $Movie = Movie::limit(5)->get();

        

        return response()->json($Movie);
    }
     
}
