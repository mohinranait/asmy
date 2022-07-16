<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\SubCategory;
use App\Models\District;
use App\Models\Upzila;
use App\Models\HomeSlider;
use App\Models\User;
use DB;
use Auth;
use Image;
use File;


class FrontendPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $products = Product::where('status',1)->latest()->get();
        $categorys= PrimaryCategory::orderby('name','asc')->where('status',1)->where('image', "!=" , NULL)->paginate(6);
        $electronics_products_new = Product::where('status',1)->latest()->where('category_id',3)->get();
        $camera_products_new = Product::where('status',1)->latest()->where('category_id',1)->get();
        $main_sliders = HomeSlider::where('status',1)->get();
        

        // Top Selling product code start
        $items = DB::table('carts')->select('product_id' , DB::raw('SUM(cart_qty) as count'))->where('order_id', "!=" , NULL)->groupBy('product_id')->orderBy('count','desc')->get();
        $products_ids = [];
        foreach ($items as $item) {
            array_push( $products_ids , $item->product_id);
        }
        $ordybrSelling = implode(',' , array_fill(0 , count($products_ids) , '?'));
        $best_selling = Product::whereIn('id', $products_ids)->orderbyRaw("field(id,{$ordybrSelling})" , $products_ids )->get();
       // Top Selling product code end
        
                            
        return view('frontend.pages.home',compact('categorys','products','electronics_products_new','main_sliders','camera_products_new','best_selling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products( $slug )
    {
        $product = Product::where('slug', $slug)->first();
        if( $product){
            $attributes = ProductAttribute::where('product_id', $product->id)->get();
            $sub_category_id = $product->sub_category_id;
            $related_products = Product::where('sub_category_id', $sub_category_id )->where('status',1)->get();
            return view('frontend.pages.products',compact('product','attributes','related_products'));
        }
    }

    public function shopOne (){
        $products = Product::orderby('id','desc')->where('status',1)->paginate(10);
        return view('frontend.pages.shop_one',compact('products'));
    }

    public function shopTwo(){
        $products = Product::orderby('id','desc')->where('status',1)->paginate(10);
        return view('frontend.pages.shop_two',compact('products'));
    }

    // Primary Category wish product display
    public function categoryWishProduct($slug){
        $category_id_find = PrimaryCategory::where('slug', $slug)->first();
        if( $category_id_find){
            $cat_id = $category_id_find->id;
            $products = Product::orderby('id','desc')->where('status',1)->where('category_id', $cat_id)->paginate(10);
            return view('frontend.pages.primary_category_wish_product',compact('products'));
        }
    }

    // Sub Category wish product display
    public function subCategoryWishProduct($slug){

        $category_id_find = SubCategory::where('slug', $slug)->first();
        if( $category_id_find){
            $cat_id = $category_id_find->id;
            $products = Product::orderby('id','desc')->where('status',1)->where('sub_category_id', $cat_id)->paginate(10);
            return view('frontend.pages.sub_category_wish_product',compact('products'));
        }
    }

    // Offer product
    public function offerSelling(){

    
        $products = Product::orderby('id','desc')->where('status',1)->where('is_fiture', 1 )->paginate(10);
        return view('frontend.pages.offer_selling_product',compact('products'));
        
    }

   
    public function checkout()
    {
        $districts = District::orderby('name','asc')->where('status',1)->get();
        $upzilas = Upzila::orderby('name','asc')->where('status',1)->get();
        return view('frontend.pages.checkout',compact('districts','upzilas'));
    }

   
    public function myAccount()
    {
        $districts = District::orderby('name','asc')->where('status',1)->get();
        $upzilas = Upzila::orderby('name','asc')->where('status',1)->get();
        return view('frontend.pages.user.user_dashboard',compact('districts','upzilas'));
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

    // user dashboard update district find
    public function userDashboardDistrictFind($id){
        $upzilas = DB::table('upzilas')->where('district_id', $id)->get();
        return response()->json($upzilas);
    }

    // Checkout District  find
    public function checkoutDistrict($id){
        $upzilas = DB::table('upzilas')->where('district_id', $id)->get();
        return response()->json($upzilas);
    }
    // My Account update
    public function myAccountUpdate( Request $request, $id){
        $user = User::find($id);
        $user->name  = $request->name;
        $user->phone  = $request->phone;
        $user->address  = $request->address;
        $user->district  = $request->district;
        $user->upzila  = $request->upzila;
        
        if( $request->profile ){
            if( File::exists('image/' . $user->profile)){
                File::delete('image/' . $user->profile);
            }
            $catchImg = $request->file('profile');
            $imgName = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->resize(200 , 200)->save($location);
            $user->profile = $imgName;
            $user->save();
        }

        return back()->with('success','Profile has been update successfully');
    }



    public function ajaxCat(Request $request){
        if( isset($request->category) ){
            $categorys = $request->category; // Find primary category id
            $lul = explode(",",$categorys);
            $products = DB::table('products')->whereIn('category_id', $lul )->get();
            
            // response()->json($products);
            return view('frontend.pages.ajax_product',compact('products'));

            // if( $products){

            //     return view('frontend.pages.ajax_product',compact('products'));
            // }else{
            //     return 'hi';
            // }
            // return $products;
            // response()->json($products);
           
        }
    }
}
