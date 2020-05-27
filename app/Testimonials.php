<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testimonials extends Model
{
    protected $table = 'testimonials';
    protected $fillable = ['image','description','id','name'];

}
