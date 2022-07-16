<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Color;
use File;
use Image;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderby('name','asc')->paginate(7);
        return view('backend.pages.color.index' , compact('colors'));
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
            'name' => ['required', 'string', 'unique:colors'],
        ]);

        if( !empty($request->color_img ) || !empty($request->color_code) ){
            $color = new Color();
            $color->name = $request->name;
            $color->slug = Str::slug($request->name);
            $color->color_code = $request->color_code;
            $color->status = $request->status;

            if( $request->color_img){
                $catchImg = $request->file('color_img');
                $imgName = time()."_". $catchImg->getClientOriginalName();
                $location = public_path('image/' . $imgName);
                Image::make($catchImg)->save($location);
                $color->color_img = $imgName;
            }

            $color->save();
            return back()->with('success', 'Create Successfully');
        }else{
            return back()->with('info', 'Color image Or Color code empty');
        }
        
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
        $color = Color::find($id);
        if( $color ){
            return view('backend.pages.color.edit', compact('color'));
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
        $color = Color::find($id);
        $color->name = $request->name;
        if($request->slug){
            $color->slug = Str::slug($request->slug);
        }else{
            $color->slug = Str::slug($request->name);
        }
        $color->color_code = $request->color_code;
        $color->status = $request->status;

        if( $request->color_img){

            if( File::exists('image/' . $color->color_img)){
                File::delete('image/' . $color->color_img);
            }

            $catchImg = $request->file('color_img');
            $imgName = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgName);
            Image::make($catchImg)->save($location);
            $color->color_img = $imgName;
        }

        $color->save();
        return redirect()->route('color.index')->with('success', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        if( $color){
            if( File::exists('image/' . $color->color_img)){
                File::delete('image/' . $color->color_img);
            }
            $color->delete();
        }
        return redirect()->route('color.index')->with('success', 'Delete Successfully');
    }

    // Color status on / off
    public function colorStatus(Request $request){
        $color = Color::find($request->color_id);
        $color->status = $request->color_status;
        $color->save();
    }

    // Color keyup search
    public function colorKeyup(Request $request){
        $colors = Color::orWhere('name','LIKE',"%". $request->color_id ."%")->orWhere('color_code',"LIKE","%". $request->color_id ."%")->orderby('name','asc')->paginate(7);

        if( $colors->count() >= 1){
            return view('backend.pages.color.keyup',compact('colors'));
        }else{
            return response()->json([
                'status' => 'nothing',
            ]);
        }
    }
}
