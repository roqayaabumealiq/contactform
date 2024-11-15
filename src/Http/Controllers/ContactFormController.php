<?php

namespace Roqayapackage\Contactform\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Roqayapackage\Contactform\Models\Contact;
use Roqayapackage\Contactform\Mail\InquiryEmail;
use Illuminate\Support\Facades\Mail;
class ContactformController extends BaseController

{
 
    public function create(){
        return view('contactform::create');
    }

    public function store(Request $request){
        $validated=$request->validate([
            'name'=> 'required|max:255',
            'email'=>'required|email|max:255',
            'company'=> 'required|max:255',
            'message'=> 'required',

        ]);

        Contact::create($validated);

        $admin_email=\config('contactform.admin_email');

        if($admin_email===null || $admin_email===''){
            echo 'The value of admin email not set';
        }else{
            Mail::to($admin_email)->send(new InquiryEmail($validated));
        }

        return back()->with('success','Inquriy sent,please wait for respon');
    }
}