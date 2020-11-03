<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id')->withDefault([
            'category' => 'no category found',
        ]);
    }

    public function tag(){
        return $this->belongsToMany('App\Models\Tag','blog_tag','blog_id','tag_id');
    }
}
