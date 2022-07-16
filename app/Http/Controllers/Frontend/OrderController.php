<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Auth;

class OrderController extends Controller
{
   
    // Order place
    public function orderStore(Request $request)
    {
        $orders  = new Order();
        $orders->name           = $request->name;
        $orders->email          = $request->email;
        $orders->phone          = $request->phone;
        $orders->total_price    = $request->total_price;
        $orders->address        = $request->address;
        $orders->transaction_id = $request->transaction_id;
        $orders->district       = $request->district_id;
        $orders->upzila         = $request->upzila_id;
        $orders->user_id        = Auth::id();

        $orders->save();

        $carts = Cart::where('ip_address', request()->ip())->where('order_id',NULL)->get();
        foreach ( $carts as  $value) {
            $value->order_id = $orders->id;
            $value->unit_price = $value->products->offer_price? $value->products->offer_price : $value->products->regular_price ;
            $value->save();
        }

        // Insert user information 
        $user = User::where('id',Auth::id())->first();
        if( $user){
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->district = $request->district;
            $user->upzila = $request->upzila;
            $user->save();
        }

        return redirect()->back()->with('success' , 'Thanks! Your Order has been submitted. You will be contacted very soon. ');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
