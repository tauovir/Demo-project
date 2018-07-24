<?php

namespace App\WebModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
      use Notifiable;
     protected $connection = 'mysql'; // Default connection
      
     protected $primaryKey = 'cust_id'; // Laravel consired Id in each table, but we have cust_id so we have to write it
      
/***********************************
 * Description: For managing Multi connection,so we can change our Connection by providing connect name
 * 
 ******************************/  
     
   function __construct() {
       $this->connection = Config('AppConstant.WEB_MYSQL'); // If other connection require for API
    } 
    
 /**
  * @Description :  Laravel automatically fetch password for Auth attempts(login),
  * So we have to override it because in our DB we cust_password_encrypt instead password
  * Date:24-05-2018
  */   
    public function getAuthPassword() {
    return $this->cust_password_encrypt;
}
    
public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }

/**
 * @Description: Get profile Data
 * @param int $id
 * @return type
 */
public static function profileData(array $condition):?Customer  {
     $userData = Customer::select('cust_id','cust_first_name','cust_last_name','cust_dob','cust_gender','cust_adrs','cust_city','cust_state','cust_phone','cust_password_code_expire')->where($condition)->first(); 

   return $userData;  
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
 * @Description: Update Customer Field according to condition
 */
public static function updateField(array $updateField,array $condition):bool  {
  $flag= Customer::where($condition)->update($updateField);
  return $flag;
}
}