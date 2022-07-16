<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Color;
use App\Models\Brand;
use App\Models\PrimaryCategory;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\ProductAttribute;
use File;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('name','asc')->get();
       
        return view('backend.pages.product.manage',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::orderby('name','asc')->where('status',1)->get();
        $brands = Brand::orderby('name','asc')->where('status',1)->get();
        $categorys = PrimaryCategory::orderby('name','asc')->where('status',1)->get();
        
        return view('backend.pages.product.create',compact('brands','colors','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_product = new Product();
        $new_product->name              = $request->name;
        $new_product->slug              = Str::slug($request->name);
        $new_product->quentity          = $request->quentity;
        $new_product->regular_price     = $request->regular_price;
        $new_product->offer_price       = $request->offer_price;
        $new_product->sort_discription   = $request->sort_discription;
        $new_product->description       = $request->descriptionid;
        $new_product->status            = $request->status;
        $new_product->meta_title        = $request->meta_title;
        $new_product->meta_discription  = $request->meta_discription;
        $new_product->meta_keyword      = $request->meta_keyword;
        $new_product->category_id       = $request->category_id;
        $new_product->brand_id          = $request->brand_id;
        $new_product->sub_category_id   = $request->sub_category_id;
        $new_product->unique_id         = $request->unique_id;
      
        
        if( $request->main_image ){
           
            $catchImg = $request->file('main_image');
            $imgName = rand(1,9)."_". $catchImg->getClientOriginalExtension();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $new_product->main_image = $imgName;            
        }
        
        if( $request->gallary_one ){
           
            $catchImg = $request->file('gallary_one');
            $nameimg = rand(1,9)."_". $catchImg->getClientOriginalExtension();
            $location = public_path('image/' . $nameimg);
            Image::make($catchImg)->save($location);
            $new_product->gallary_one = $imgName;            
        }
        
        if( $request->gallary_two ){
           
            $catchImg = $request->file('gallary_two');
            $imgName = rand(1,9)."_". $catchImg->getClientOriginalExtension();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $new_product->gallary_two = $imgName;            
        }

        // dd( $new_product); exit;

        $new_product->save();
        return redirect()->route('product.index')->with('success','Product save successfully');

      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::all();
        return view('welcome',compact('products'));
    }
    public function details($id)
    {
        $product = Product::find($id);
        $tags = $product->meta_keyword;
        $tags_string = explode(",", $tags);
        return view('product',compact('product','tags_string'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if( $product ){
            $colors = Color::orderby('name','asc')->where('status',1)->get();
            $brands = Brand::orderby('name','asc')->where('status',1)->get();
            $categorys = PrimaryCategory::orderby('name','asc')->where('status',1)->get();
            $sub_categorys = SubCategory::orderby('name','asc')->get();
            return view('backend.pages.product.edit',compact('product','colors','brands','categorys','sub_categorys'));
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
        $new_product =  Product::find($id);
        $new_product->name              = $request->name;
        $new_product->slug              = Str::slug($request->name);
        $new_product->quentity          = $request->quentity;
        $new_product->regular_price     = $request->regular_price;
        $new_product->offer_price       = $request->offer_price;
        $new_product->sort_discription   = $request->sort_discription;
        $new_product->description       = $request->descriptionid;
        $new_product->status            = $request->status;
        $new_product->meta_title        = $request->meta_title;
        $new_product->meta_discription  = $request->meta_discription;
        $new_product->meta_keyword      = $request->meta_keyword;
        $new_product->category_id       = $request->category_id;
        $new_product->brand_id          = $request->brand_id;
        $new_product->sub_category_id   = $request->sub_category_id;
        $new_product->unique_id         = $request->unique_id;
      
        
        if( $request->main_image ){
           
            $catchImg = $request->file('main_image');
            $imgName = rand(1,9)."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $new_product->main_image = $imgName;            
        }
        
        if( $request->gallary_one ){
           
            $catchImg = $request->file('gallary_one');
            $nameimg = rand(1,9)."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $nameimg);
            Image::make($catchImg)->save($location);
            $new_product->gallary_one = $nameimg;            
        }
        
        if( $request->gallary_two ){
           
            $catchImg = $request->file('gallary_two');
            $imgName = rand(1,9)."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $new_product->gallary_two = $imgName;            
        }

        // dd( $new_product); exit;

        $new_product->save();
        return redirect()->route('product.index')->with('success','Product Update successfully');

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

    // Product Attribute
    public function productAtribute(Request $request, $id){
        $product = Product::select('id','name','regular_price','offer_price','unique_id','main_image')->with('productAttribute')->find($id);

        return view('backend.pages.product.add_edit_attributes',compact("product"));
    }
    
    // Product attribute Store
    public function productStore(Request $request  ){
     
        if( $request->isMethod('post')){
            $data = $request->all();

            foreach ($data['sku'] as $key => $value) {
                if( !empty( $value )){
                    // color duplicate check
                    $sizCheck = ProductAttribute::where('product_id', $request->product_id)->where('color',$value)->count();
                    if( $sizCheck > 0){
                        return redirect()->back()->with('warning','Color already exists! Please add another Color');
                    }

                    // SKU duplicate check
                    $skuCount = ProductAttribute::where('product_id', $request->product_id)->where('sku',$value)->count();
                    if( $skuCount > 0){
                        return redirect()->back()->with('warning','SKU already exists! Please add another SKU');
                    }
                   
                    // $data_id = $data->id;
                    $attribute = new ProductAttribute();
                    $attribute->product_id = $request->product_id;
                    $attribute->sku = $value;
                    $attribute->color = $data['color'][$key];
                    $attribute->stock = $data['stock'][$key];

                    // dd($attribute); exit;
                    $attribute->save();
                }
            }
            return back()->with('success','Product Attributes has been added successfully');
        }
       
    }

     // Attribute update
     public function attributeUpdate(Request $request){
        if( $request->isMethod('post')){
            $data = $request->all();
            // dd($data); exit;
            foreach ($data['attributeId'] as $key => $attribute) {
                if( !empty( $attribute)){
                    ProductAttribute::where(['id'=>$data['attributeId'][$key]])->update(
                    [
                        'stock'=>$data['stock'][$key],
                        'color'=>$data['color'][$key],
                        'sku'=>$data['sku'][$key],
                    ]);
                }
            }
            return back()->with('success','Product Attributes has been Update successfully');
        }
    }

    // Attribute Delete
    public function attributeDelete($id){
        $attribute = ProductAttribute::find($id);
        if( $attribute){
            $attribute->delete();
        }
        return back()->with('success','Product Attributes has been Delete successfully');
    }


    // Primary Category wish sub category find
    public function primayCategoryFidnWithSubCategory($id){

        $subCategory = DB::table('sub_categories')->where('primary_category_id', $id)->get();
        return response()->json($subCategory);
    }

    // Product Status on / off
    public function productStatus(Request $request){
        $products = Product::find($request->productId);
        $products->status = $request->productStatus;
        $products->save();

    }


    // Product keyup search
    public function backendProductKeyup(Request $request){
        $products = Product::orWhere('name' , "LIKE", "%". $request->product_string ."%")
                            ->orWhere('unique_id',"LIKE" , "%" . $request->product_string ."%")
                            ->orderby('name','asc')->paginate(10);

        if( $products->count() >= 1){
            return view('backend.pages.product.keyup-search', compact('products'));
        }else{
            return response()->json([
                'status'=>'nothing',
            ]);
        }
    }
}
