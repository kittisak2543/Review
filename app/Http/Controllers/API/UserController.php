<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Arr;


class UserController extends Controller
{

     public function register(Request $request){
         
          $fields = $request->validate([
               'name' => 'required|string',
               'email' => 'required|string|unique:users,email',
               'password' => 'required|string|confirmed'
          ]);
          $user = User::create([
               'name' => $fields['name'],
               'email' => $fields['email'],
               'password' => bcrypt($fields['password'])
               
          ]);
          $user->message = "Register success";
          $user->status = "true";
          return response()->json($user);
         
          
     }
     public function login(Request $request){
          $fields = $request->validate([
               'email' => 'required|string',
               'password' => 'required|string'
          ]);
         
          // check email
          $user = User::where('email',$fields['email'])->first();
          
          //check password
        
          if($user){
               $users = Hash::check($fields['password'],$user->password);
               if($users == false){
                    $users['message'] = "Please enter your password again.";
                    $users['status'] = "false";
                    return response()->json($users);
               }
               if(!$user || !Hash::check($fields['password'],$user->password) ){
                    $users['message'] = "Don't found this account.";
                    $users['status'] = "false";
                    return response()->json($users);
               }
               else{
                    if($user){
      
                         $user['message'] = "Login success.";
                         $user['status'] = "true";
                         return response()->json($user);
               
                      }
                      else{
                         $users['message'] = "Don't found this accoutn.";
                         $users['status'] = "false";
                         return response()->json($users);
                      }
                    
               }
          }else{
               $users['message'] = "Don't found this accoutn.";
               $users['status'] = "false";
               return response()->json($users);
          }
          return response()->json($user);

          

         
     }
     
   
    public function profile($id){
          $user = User::all();

          $user = $user->find($id);

          if($user){
                
                $user['message'] = "Success.";
                $user['status'] = "true";
          }
          else{
               $user['message'] = "Don't success";
               $user['status'] = "false";
   
          }
          return response()->json($user);
    }
    public function update(Request $request)
    {
          
          $file = $request->file("profile_photo_path");

          $user = User::all();
          $user = $user->find($request->id);
          if(isset($file)){
               $file->move("assets/user", $file->getClientOriginalName());
               $user->profile_photo_path =  $file->getClientOriginalName();
          }else{
               $user->profile_photo_path =  $user->profile_photo_path;
          }
          $user->name = $request->name;
          
          $user->password = $user->password;
          if($request->first_name != ""){
               $user->first_name = $request->first_name;
          
          }
          if($request->last_name != ""){
               $user->last_name =  $request->last_name;
          }
          if($request->name != ""){
               $user->name = $request->name;
          }
          if($request->password != ""){
               $user->password = $request->password;
          }
         
          $user->save();
          
          return response()->json(
          array('message'=>'update a user successfully',
          'status'=>'true'));        

    }
}
