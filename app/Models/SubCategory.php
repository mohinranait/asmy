<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','primary_category_id','image','status'];

    public function primaryCategory(){
        return $this->belongsTo(primaryCategory::class);
    }
}
