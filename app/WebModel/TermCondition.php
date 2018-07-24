<?php

namespace App\WebModel;

use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    
     protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.WEB_MYSQL'); // If other connection require for API
    }
    
  /**
   * @Date:15-05-2018
   * @Description: Get Term & Condition and Privacy policy data
   */  
  public static function getData():?TermCondition{
      $data = TermCondition::all()->first();;
     return $data;
  } 
}
