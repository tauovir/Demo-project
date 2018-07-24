<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    protected $connection = 'mysql'; // Default connection
      function __construct() {
       $this->connection = Config('AppConstant.API_MYSQL'); // If other connection require for API
    }
  
/**
 * @Description: Fetch all active country
 * @return \Illuminate\Support\Collection
 */  
 public static function getActiveCountries(): \Illuminate\Support\Collection {
    $countryList = Country::where(['country_is_active'=> Config('AppConstant.ACTIVE')])->get();
    return $countryList;
 }   
}
