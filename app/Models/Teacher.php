<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    public function setDojAttribute( $value ) {       
        $this->attributes['doj'] = (new Carbon($value))->format('Y-m-d');
     }
    
    public function getDojAttribute($value){
          return (new Carbon($value))->format('d-m-Y');
    }
}
