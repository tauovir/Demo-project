<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    // public $timestamps = false; // Set false if we are not using laravel created_at and updated_at 
      protected $hidden = [
        'cust_password_encrypt',
    ];
      protected $connection = 'mysql'; // Default connection
      
      function __construct() {
       $this->connection = Config('AppConstant.API_MYSQL'); // If other connection require for API
    }
    
 /**
  * @Description: Check data already exist according to condition
  * @param array $condition
  * @return \App\ApiModel\Customer
  */  
    public static function isExist(array $condition):?Customer  {
      
     $userData = Customer::where($condition)->first();
     return $userData;  
}

/**
 * @Description: Get profile Data
 * @param int $id
 * @return type
 */
public static function profileData(int $id):?Customer  {
     $userData = Customer::select('cust_first_name','cust_last_name','cust_email','cust_username','cust_dob','cust_gender','cust_adrs','cust_city','cust_state','cust_phone')->where(['cust_id'=>$id])->first(); 

   return $userData;  
}

/**
 * @Description: Update Customer Field according to condition
 */
public static function updateField(array $updateField,array $condition):void  {
  $userData = Customer::where($condition)->update($updateField);
}

}