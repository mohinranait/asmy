<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Product;
use Auth;
use DB;

class CartController extends Controller
{
   
    // Product Details page add to cart function 
    public function productDetailsAddToCartStore(Request $request)
    {
       
        $qty = $request->cart_qty;
        // This Product attribute count  
        $attributes = ProductAttribute::select('product_id')->where('product_id', $request->product_id)->count();
        if($attributes > 0){
            // request color product stock check 
            $stock_colror = ProductAttribute::select('stock')->where('color', $request->attribute)->first();
            $stocks = $stock_colror->stock;
            if( $stocks < $qty ){
                return redirect()->back()->with('warning','Request Color is not Available! Please Select a another color.');
            }
    
            // Request Color Product check in cart (exists or not)
            $existsValue = Cart::select('attribute')->where('product_id', $request->product_id)->where('attribute', $request->attribute)->count();
            if( $existsValue > 0){
                return redirect()->back()->with('warning','This product already exists! Go back your shopping cart and update it.');
            }
        }else{

            $stockOutProduct = Product::select('quentity')->where('id',$request->product_id)->first();
            $stockQuintity  = $stockOutProduct->quentity;
            if( $stockQuintity < $qty ){
                return redirect()->back()->with('warning','Out of stock');
            }

            // check product already exists value
            $existsProduct = Cart::where('ip_address', Request()->ip() )->where('product_id', $request->product_id)->where('order_id', NULL)->first();
            if( $existsProduct ){
                $count_cart_qty =  $existsProduct->cart_qty;
                $existsProduct->cart_qty = $qty + $count_cart_qty  ;
                $existsProduct->save();
                return back()->with('success','Product has been added');
            }
        }

        // Insert to cart Model 
        $cart = new Cart();
        $cart->product_id   = $request->product_id;
        $cart->user_id      = $request->user_id;
        $cart->attribute    = $request->attribute;
        $cart->cart_qty     = $request->cart_qty;
        $cart->ip_address   = request()->ip();
        $cart->save();
        return redirect()->back()->with('success', 'Product added to cart');
    }

    // Single product store
    public function addedToCart(Request $request )
    {

        // Product quentity check
        $products = Product::where('id' , $request->product_id)->first();
        if( $products){
            $quentitCount = $products->quentity;
            if( $quentitCount < 1){
                return back()->with('warning','This Product Out of Stock');
            };
        };


        // If this product is already carted 
        $carts = Cart::where('ip_address' , Request()->ip() )->where('order_id',NULL)->where('product_id', $request->product_id )->first();
        if( $carts){
        $count_cart =  $carts->cart_qty;
        $carts->cart_qty = $count_cart + 1 ;
        $carts->save();
        return back()->with('success','Product has been added');
        }

        // Product add to cart 
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id  = $request->user_id ;
        $cart->ip_address  = Request()->ip() ;
        $cart->cart_qty  = 1;
        $cart->save();
        return back()->with('success','Product has been added');
    }


    // Cart page
    public function cart()
    {
        $cartItems = Cart::userCartItems();
        $totalPrices = Cart::totalPrice();
        return view('frontend.pages.cart_page',compact('cartItems','totalPrices'));
    }


    // Cart quentityy update function
    public function cartQuintity(Request $request){
        $carts = Cart::where('id',$request->cart_id)->first();
        $carts->cart_qty = $request->cart_val;
        $carts->save();
        if( $carts){
            return response()->json([
                'status'=>'nothing',
                
            ]);
        }
    }

    // Cart item delete
    public function cartDelete( $id){
        $carts = Cart::find($id);
        if( $carts){
            $carts->delete();
        };
        return redirect()->back()->with('success','Delete item in your cart');
    }

    
   

   
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Checkout s
}
