<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use Image;
use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderby('name','asc')->paginate(7);
        return view('backend.pages.brand.index',compact('brands'));
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

        $request->validate([
            'name' => ['required', 'string', 'unique:brands'],
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = $request->status;

        if( $request->image ){
            $catchImg = $request->file('image');
            $imgName = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $brand->image = $imgName;
        }

        $brand->save();
        return back()->with('success','Create Successfully');
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
        $brand = Brand::find($id);
        if( $brand){
            return view('backend.pages.brand.edit',compact('brand'));
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
        $this->validate($request, [
            "name" => 'required|unique:brands,name,'.$id,
        ]);

        $brand =  Brand::find($id);
        $brand->name = $request->name;
        if($request->slug){
            $brand->slug = Str::slug($request->slug);
        }else{
            $brand->slug = Str::slug($request->name);
        }
        $brand->status = $request->status;

        if( $request->image ){
            if( File::exists('image/' . $brand->image)){
                File::delete('image/' . $brand->image);
            }
            $catchImg = $request->file('image');
            $imgName = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $brand->image = $imgName;
        }

        $brand->save();
        return redirect()->route('brand.index')->with('success','Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if( $brand ){

            if( File::exists('image/' . $brand->image)){
                File::delete('image/' . $brand->image);
            };
            $brand->delete();
        }
        return redirect()->route('brand.index')->with('success','Delete Successfully');
           
        
    }

    // Brand Status on / off
    public function brandStatus(Request $request){
        $brands = Brand::find($request->brand_id);
        $brands->status = $request->brand_status;
        $brands->save();

    }

    // Brand keyup search
    public function brandKeyup(Request $request){
        $brands = Brand::orWhere('name','LIKE',"%". $request->brand_id . "%")->orderby('name','asc')->paginate(7);

        if( $brands->count() >= 1 ){
            return view('backend.pages.brand.keyup', compact('brands'));
        }else{
            return response()->json([
                'status' => 'nothing',
            ]);
        }
    }
}
