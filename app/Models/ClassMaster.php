<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassMaster extends Model
{
    use HasFactory,SoftDeletes;

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
}
