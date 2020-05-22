<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class work_strategy extends Model
{
    protected $fillable =  ['id' , 'title', 'image' , 'description'];

    public function title()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'currency_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
