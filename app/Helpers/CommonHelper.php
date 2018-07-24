<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\WebModel\Customer;
class CommonHelper {

    /**
     * @Descripton : It is used to return json response for API
     * @param type $error_code
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function displayMessage(int $error_code, string $message = '', $data = array()) : array {
        $temp['code'] = $error_code;
        $temp['message'] = $message;
        $temp['data'] = $data;
        return $temp;
    }

   
     /**
     * @Descripton : It is used to generate random string for Api token
     * @param type $error_code
     * @param type $message
     * @param type $data
     * @return type
     */
    public static function randomString(int $length) : string {
      
       $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $time = time();
         $randomStr = $randomString.'_'.$time;
         return $randomStr;
    }

   
 
/**
 * Description: Send Suggested User name on behalf of customer email
 * Date : 22-05-2018
 */
   
    public static function suggestedName(string $email) :string
    {
        $flag = false;
        $arr = explode('@', $email);
        if (count($arr) > 0) {
            $userName = trim($arr[0]);;
            if (strlen($userName) < 3) {
                $tempCode = rand(1, 999);
                $userName = $userName."_".$tempCode; 
            }
                $condition = ['cust_username' => $userName];
                $isExist = Customer::isExist($condition);
            if (!$isExist) {
                return $userName;
            }
            while ($flag == false) {
                $tempCode = rand(1, 999);
                $userName = $userName."_".$tempCode;
                $condition = ['cust_username' => $userName];
                $isExist = Customer::isExist($condition);
                if (!$isExist) {
                        $flag = true;
                }
            }
            return $userName;
        }
    }
    public static function temporaryPassword() :int
    {
        $tempCode = rand(99999, 999999);
        return $tempCode;
    }
}

