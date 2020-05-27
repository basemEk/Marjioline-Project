<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Programs extends Model
{
    protected $table = 'programs';
    protected $fillable = ['title', 'image', 'description', 'is_organization', 'slug'];

}
