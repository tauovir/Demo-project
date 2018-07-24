<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class CustomerSession extends Model
{
    //
     public $timestamps = false; // Set false if we are not using laravel created_at and updated_

     protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.API_MYSQL'); // If other connection require for API
    }
    
/**
 * @Description: Get Session data when Api token is valid 
 * @param type string 
 * @return type CustomerSession or Null
 */    
  public static function getSessionData(string $apiToken):?CustomerSession  {
   
               $sesstionData = CustomerSession::join('customers', 'customer_sessions.cust_id', '=', 'customers.cust_id')
                       ->select('customer_sessions.platform','customer_sessions.device_token','customer_sessions.device_id','customer_sessions.lang','customer_sessions.login_type','customers.cust_id','customers.cust_first_name','customers.cust_last_name','customers.cust_status','customers.cust_password_encrypt')
                       ->where(['customer_sessions.api_token' => $apiToken])
                        ->first();
            return $sesstionData;
    }
     
/**
 * @Description: Logout Sesstion
 * @param array $condition
 * @return type int
 */ 
public static function logoutSession(array $condition):?int  {
  $flag = CustomerSession::where($condition)->delete();
  return $flag;
}
   
/**
 * @Description: Check Session Exist so we can update on it
 * @param array $condition
 *  @return type Customer or Null
 * 
 */
 public static function isSessionExist(array $condition):?CustomerSession  {
     $sessionData = CustomerSession::where($condition)->first();
     return $sessionData;  
}
/**
 * @Description: Update Session Data
 *  @param array $updateField
 *  @param array $condition
 * @return void
 */
public static function updateSession(array $updateField,array $condition):void  {
  CustomerSession::where($condition)->update($updateField);
}
}
