<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

/************************************
 * Description: This is Language Model which is associated with language table
 * 
 ***********************************/
class Language extends Model
{
     protected $connection = 'mysql'; // Default connection
     
      function __construct() {
       $this->connection = Config('AppConstant.API_MYSQL'); // If other connection require for API
        }
 /**************************************************
 * @Description: Fetch all active Language
 * Date : 21-05-2018 
 * @return \Illuminate\Support\Collection
 *****************************************/  
 public static function getActiveLanguage(): \Illuminate\Support\Collection {
    $countryList = Language::select('language_id','lang_description','lang_local')->where(['lang_is_active'=> Config('AppConstant.ACTIVE')])->get();
    return $countryList;
 }  
    
}
