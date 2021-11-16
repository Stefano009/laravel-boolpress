<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Lead;
use App\Mail\SendNewMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function listPostsApi(){
        return view('api.home');
    }


    public function contact(){
        return view('guest.contact');
    }

    public function handleContactForm(Request $request){
        // method to save data from the form
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();
    
        Mail::to('info@boolpress.com')->send(new SendNewMail($new_lead));
        return redirect()->route('contact.thank-you');
    }

    public function thankYou(){
        return view('guest.thank-you');
    }
}
