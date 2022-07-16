<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PrimaryCategory;
use Image;
use File;

class PrimaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = PrimaryCategory::orderby('name','asc')->paginate(7);
        return view('backend.pages.category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
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
            'name' => ['required', 'string', 'unique:primary_categories'],
            'image' => ['required'],
        ]);


        $category = new PrimaryCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        if( $request->image){
            $catchImg = $request->file('image');
            $imgName = time() ."_". $catchImg->getClientOriginalName();
            $location  = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $category->image = $imgName;
        }

       $category->save();
       return redirect()->back()->with('success', "Create Successfull");

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
        $category  = PrimaryCategory::find($id);
        if( $category){
            return view('backend.pages.category.edit', compact('category'));
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
            "name" => 'required|unique:primary_categories,name,'.$id,
            "slug" => 'required|unique:primary_categories,slug,'.$id,
            
        ]);


        $category =  PrimaryCategory::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;

        if( $request->image){
            if( File::exists('image/' . $category->image)){
                File::delete('image/' . $category->image);
            }

            $catchImg = $request->file('image');
            $imgName = time() ."_". $catchImg->getClientOriginalName();
            $location  = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $category->image = $imgName;
        }

       $category->save();
       return redirect()->route('category.index')->with('success', "Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category  = PrimaryCategory::find($id);
        if( $category){
            if( File::exists('image/' . $category->image)){
                File::delete('image/' . $category->image);
            }

            $category->delete();
        }
        return redirect()->route('category.index')->with('success', "Delete Successfully");
    }


    // Ajax route
    public function primaryCategoryKeyup(Request $request){

        $categorys = PrimaryCategory::orderby('name','asc')->orWhere('name', "LIKE" , "%" . $request->category_id . "%")->paginate(7);

        if( $categorys->count() >= 1 ){
            return view('backend.pages.category.keyup-search', compact('categorys'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
    }


    public function primaryCategoryStatus(Request $request){
        $category = PrimaryCategory::find($request->cat_id);

        $category->status = $request->cat_status;
        $category->save();
        return response()->json(['success' => 'Status Changed Successfully']);
    }


   
}
