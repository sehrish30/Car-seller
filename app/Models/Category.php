<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // modify all properties empty means modify any property we want
    protected $guarded = [];

    public function products(){
        return $this->hasMany('App\Models\Product', 'product_id');
    }
}
