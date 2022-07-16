<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\District;
use App\Models\Upzila;
use DB;


class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderby('id','desc')->paginate(7);
        return view('backend.pages.order.admin_order_manage',compact('orders'));
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
        $order = Order::find($id);
        if( $order){
            $carts = Cart::where('order_id', $order->id)->where('cart_qty', ">=" , 1)->get();
            return view('backend.pages.order.admin_order_show',compact('order','carts'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        if( $order){
            $districts = District::orderby('name','asc')->where('status',1)->get();
            $upzilas = Upzila::orderby('name','asc')->where('status',1)->get();
            return view('backend.pages.order.admin_order_edit',compact('order','districts','upzilas'));
        }else{
            return back();
        }
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
        $order = Order::find($id);
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->district = $request->district;
        $order->upzila = $request->upzila;
        $order->transaction_id = $request->transaction_id;
        $order->total_price = $request->total_price;
        $order->payment_method = $request->payment_method;
        $order->is_paid = $request->is_paid;
        $order->status = $request->status;

       $order->save();
       return redirect()->route('order.index')->with('success','Order update successfully');

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

    public function orderdistrictUpdate($name){
        $upzilas = DB::table('upzilas')->where('district_id', $name)->get();
        return response()->json($upzilas);
    }
}
