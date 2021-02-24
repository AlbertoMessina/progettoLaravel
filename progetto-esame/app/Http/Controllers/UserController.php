<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public Function index()
   {
       return view('dashboard');
   }

   public Function profile()
   {
      return view('userProfile');
   }


   /*public Function subScribe(){

      return view('register');

   }*/
}
