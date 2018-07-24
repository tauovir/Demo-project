<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebModel\TermCondition;
class ContentsController extends Controller
{
   
    
 /**
  * @Date : 15-05-2018
  * @Description:Privacy policy content
  */   
 public function privacyPolicy(){
   $data = TermCondition::getData();
   return view('web.content.privacyPolicy')->with('data',$data);
 }
 
    
 /**
  * @Date : 15-05-2018
  * @Description:Term and condition content
  */ 
 public function termCondition(){
    $data = TermCondition::getData();
   return view('web.content. termCondition')->with('data',$data);
 }   
 
 
}
