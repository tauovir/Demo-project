<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    //
 
  public function index(){
    //  dd(Auth::guard('customers')->user());
      return view('web.home.welcome');
  }  

  public function logout(){
    Auth::guard('customers')->logout();
     return redirect('/');
  }  
}
