<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;

class ContactController extends Controller
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
        return redirect('contact')->with('success','Send contact success');
    }
    public function delete(Request $request){
        //validate value
       
         //save value in database Eloquent
        $contact = contact::find($request->id);
       
        $contact->delete();
        return redirect('message')->with('success','Delete contact success');
    }
}
