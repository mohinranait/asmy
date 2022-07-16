<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = ['product_id','user_id','order_it','attribute','unit_price','cart_qty','ip_address'];

    // Product belongsTo cart
    public function products (){
        return $this->belongsTo(Product::class , 'product_id');
    }


    // all cart item 
    public static function userCartItems(){
        $cartItem = Cart::where('ip_address', request()->ip())->where('order_id',NULL)->get();
        return $cartItem;
    }

    // Total cart item count
    public static function totalCartItemCount(){
        $cartItems = Cart::where('ip_address', Request()->ip())->where('order_id',NULL)->get();

        $totalItemCount = 0;
        foreach( $cartItems as $value ){
            $totalItemCount += $value->cart_qty;
        }

        return $totalItemCount;

    }

    // Total cart price count
    public static function totalPrice(){
        $cartItems = Cart::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        $totalPrice = 0;
        foreach ($cartItems as  $value) {
            if( $value->products->offer_price ){
                $totalPrice += $value->cart_qty * $value->products->offer_price;
            }else{
                $totalPrice += $value->cart_qty * $value->products->regular_price;
            }   
        }
        return $totalPrice;
    }

   

    
  
}
