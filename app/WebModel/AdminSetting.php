<?php

namespace App\WebModel;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
   protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.WEB_MYSQL'); // If other connection require for API
    }
 /**
  * @Description: Get Admin Setting Data
  * @return type
  */   
 public static function getAdminSettingData() :?AdminSetting {
     $data = AdminSetting::all()->first();
     return $data;
 }
    
}
