<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class ContectUs extends Model
{
   
    protected $table = 'contact_us';
     public $timestamps = false; // Set false if we are not using laravel created_at and updated_
}
