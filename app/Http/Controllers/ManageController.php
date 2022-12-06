<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ManageController extends Controller
{
    public function AccountDel(Request $request){
        //validate value
       
         //save value in database Eloquent
        $user = User::find($request->id);
        
        $user->delete();
        return redirect('usertable')->with('success','Delete account success');
      
        
        
        
        
    }
}
