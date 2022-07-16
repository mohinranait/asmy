<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PrimaryCategory;
use App\Models\SubCategory;
use Session;
use File; 
use Image;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primCategory = PrimaryCategory::orderby('name','asc')->where('status',1)->get();
        $subCategory = SubCategory::orderby('name','asc')->paginate(7);
        Session::put('page' , 'show-sub');
        return view('backend.pages.subcategory.index',compact('subCategory','primCategory'));
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
            'name' => ['required', 'string', 'unique:sub_categories'],
            'primary_category_id' => ['required'],
        ]);


        $category = new SubCategory();
        $category->name                 = $request->name;
        $category->slug                 = Str::slug($request->name);
        $category->primary_category_id  = $request->primary_category_id;
        $category->status               = $request->status;

        if( $request->image){
            $catchImg       = $request->file('image');
            $imgName        = time() ."_". $catchImg->getClientOriginalName();
            $location       = public_path('image/' . $imgName);
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
        $category  = SubCategory::find($id);
        if( $category){
            $primCategory = PrimaryCategory::orderby('name','asc')->where('status',1)->get();
            return view('backend.pages.subcategory.edit', compact('category','primCategory'));
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
            "name" => 'required|unique:sub_categories,name,'.$id,
            "slug" => 'required|unique:sub_categories,slug,'.$id,
            "primary_category_id" => 'required',
            
        ]);

        $category =  SubCategory::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->primary_category_id = $request->primary_category_id;
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
       return redirect()->route('sub.category.index')->with('success', "Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category  = SubCategory::find($id);
        if( $category){
            if( File::exists('image/' . $category->image)){
                File::delete('image/' . $category->image);
            }

            $category->delete();
        }
        return redirect()->route('sub.category.index')->with('success', "Delete Successfully");
    }

     // Ajax route
     public function subCategoryKeyup(Request $request){
        $subCategory = SubCategory::orderby('name','asc')->orWhere('name', "LIKE" , "%" . $request->category_id . "%")->paginate(7);

        if( $subCategory->count() >= 1 ){
            return view('backend.pages.subcategory.keyup-search', compact('subCategory'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
    }

    // sub catehgory status change
    public function subCategoryStatus(Request $request){
        $category = SubCategory::find($request->cat_id);
        $category->status = $request->cat_status;
        $category->save();
        return response()->json(['success' => 'Status Changed Successfully']);
    }
}
