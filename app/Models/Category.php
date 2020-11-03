<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    //protected $fillable=['category'];
    public function blog()
    {
        return $this->hasMany('App\Models\Blog','id','category_id');
    }
}
