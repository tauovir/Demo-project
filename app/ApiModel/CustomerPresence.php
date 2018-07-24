<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class CustomerPresence extends Model
{
    //
      public $timestamps = false; // Set false if we are not using laravel created_at and updated_

     protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.API_MYSQL'); // If other connection require for API
    }
    
    /**
 * @Description: Check Session Exist so we can update on it
 * @param array $condition
 *  @return type Customer or Null
 * 
 */
 public static function isPresenceExist(array $condition):?CustomerPresence  {
     $data = CustomerPresence::where($condition)->first();
     return $data;  
}
}
