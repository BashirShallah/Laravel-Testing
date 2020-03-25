<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setCategory($category){
        if(! is_null($this->category_id)){
            throw new \Exception('You can not change the product category');
        }

        $this->category()->associate($category)->save();
    }
}
