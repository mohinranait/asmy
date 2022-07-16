<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'quentity',
        'regular_price',
        'offer_price',
        'sortDiscription',
        'description',
        'is_fiture',
        'status',
        'meta_title',
        'meta_discription',
        'meta_keyword',
        'view_count',
        'brand_id',
        'category_id',
        'sub_category_id',
        'color_id',
        'size_id',
    ];


    public function productImages(){
        return $this->hasMany(ProductImage::class );
    }
    // Brand belong to Products model
    public function brands(){
        return $this->belongsto(Brand::class , 'brand_id' );
    }
     // Category belong to Products model
    public function primaryCategorys(){
        return $this->belongsto(PrimaryCategory::class , 'category_id' );
    }
    // sub Category belong to Products model
    public function subCategorys(){
        return $this->belongsto(SubCategory::class , 'sub_category_id' );
    }


    // Product Attributes has many relation 
    public function productAttribute(){
        return $this->hasMany('App\Models\ProductAttribute');
    }
    
    // Products belong to Products model
    public function productColor(){
        // unnesessery function
        return $this->hasMany(ProductColor::class , 'quintity' );
    }
  
}
