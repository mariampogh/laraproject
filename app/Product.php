<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['cat_id', 'product', 'image'];


  public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
