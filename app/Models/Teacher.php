<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory,SoftDeletes;

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function setDojAttribute( $value ) {    
        
        $this->attributes['doj'] = empty($value)?'':(new Carbon($value))->format('Y-m-d');
     }
    
    public function getDojAttribute($value){
          return (new Carbon($value))->format('d-m-Y');
    }
}
