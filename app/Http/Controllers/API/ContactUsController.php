<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\contact;
use App\Http\Controllers\Controller;
class ContactUsController extends Controller
{
    public function contact(Request $request){
        //validate value
 
        $request->validate([
            'name' => 'required',
            'email' =>'required',
            'subject' =>'required',
            'message' =>'required'
        ]);
         //save value in database Eloquent
        $contact = new contact;

    
       
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        return response()->json(array("message"=>"Thank you for your contact." , "status"=>"true"));
    }
    
}
