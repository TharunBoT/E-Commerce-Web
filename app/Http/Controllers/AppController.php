<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //home page
    public function index(){
        return view('pages.home');
    }

    //password change for users
    public function pw_change(){
        return view('auth.reset-password');
    }

    //contact page
    public function contact_us(){
        return view('pages.contact-us');
    }
}
