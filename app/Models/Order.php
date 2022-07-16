<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','total_price','address','transaction_id','is_paid','status','district','upzila','user_id'];

    public function districtName(){
        return $this->belongsTo(District::class , 'district');
    }

    public function upzilas(){
        return $this->belongsTo(Upzila::class , 'upzila');
    }
}
