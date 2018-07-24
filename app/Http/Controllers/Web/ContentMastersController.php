<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebModel\ContentMaster;
class ContentMastersController extends Controller
{
   
    
 /**
  * @Date : 15-05-2018
  * @Description:Privacy policy content
  */   
 public function privacyPolicy(Request $request){
   $lang = Config('AppConstant.DEFAULT_LANGUAGE');
   
   if($request->has('lang')) {
      $lang =  $request->lang;
   }
   $condition=array('content_type'=>Config('AppConstant.CONTENT_PAGE.PRIVACY_POLICY'),'language_id'=>$lang);
   $data = ContentMaster::contentData($condition);
   return view('web.content.privacyPolicy')->with('data',$data);
 }
 
    
 /**
  * @Date : 15-05-2018
  * @Description:Term and condition content
  */ 
 public function termCondition(Request $request){
    $lang = Config('AppConstant.DEFAULT_LANGUAGE');
   if($request->has('lang')) {
      $lang =  $request->lang;
   }
   $condition=array('content_type'=>Config('AppConstant.CONTENT_PAGE.TERM_CONDITION'),'language_id'=>$lang);
     $data = ContentMaster::contentData($condition);
    
   return view('web.content.termCondition')->with('data',$data);
 }   
 
 
}
