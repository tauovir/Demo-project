<?php

namespace App\WebModel;

use Illuminate\Database\Eloquent\Model;

class ContentMaster extends Model
{
    protected $table = 'content_master';
     protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.WEB_MYSQL'); // If other connection require for API
    }
    
  /**
   * @Date:15-05-2018
   * @Description: Get Term & Condition and Privacy policy data
   */  
  public static function contentData(array $condition):?contentMaster{
      $data = ContentMaster::where($condition)->get()->first();;
     return $data;
  } 
}
