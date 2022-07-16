<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Image;
use File;

class SliderController extends Controller
{
    
    public function index()
    {
        $sliders = HomeSlider::all();
        return view('backend.pages.slider.home_slider_manage', compact('sliders'));
    }
    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {

        $request->validate([
            'main_title' => 'required',
            'link' => 'required',
            'banner' => 'required',
        ],[
            'main_title.required' => "Title is required",
            'banner.required' => "Banner is required",
        ]);

        $sliders = new HomeSlider();
        $sliders->main_title = $request->main_title;
        $sliders->sub_title = $request->sub_title;
        $sliders->link = $request->link;
        $sliders->price = $request->price;
        $sliders->status = $request->status;

        if( $request->banner ){
            $catchImg = $request->file('banner');
            $imgNmae = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgNmae);
            Image::make($catchImg)->save($location);
            $sliders->banner = $imgNmae;
        }

        $sliders->save();
        return back()->with('success','Banner has been added successfully');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $slider = HomeSlider::find($id);
        if( $slider){
            return view('backend.pages.slider.edit_slider',compact('slider'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'main_title' => 'required',
            'link' => 'required',
        ],[
            'main_title.required' => "Title is required",
        ]);

        $sliders = HomeSlider::find($id);
        $sliders->main_title = $request->main_title;
        $sliders->sub_title = $request->sub_title;
        $sliders->link = $request->link;
        $sliders->price = $request->price;
        $sliders->status = $request->status;

        if( $request->banner ){

            if( File::exists('image/' . $sliders->banner)){
                File::delete('image/' . $sliders->banner);
            }
            
            $catchImg = $request->file('banner');
            $imgNmae = time()."_". $catchImg->getClientOriginalName();
            $location = public_path('image/' . $imgNmae);
            Image::make($catchImg)->save($location);
            $sliders->banner = $imgNmae;
        }

        $sliders->save();
        return redirect()->route('slider.index')->with('success','Banner has been update successfully');
    }

   
    public function destroy($id)
    {
        $slider = HomeSlider::find($id);
        if( $slider){

            if( File::exists('image/' . $slider->banner)){
                File::delete('image/' . $slider->banner);
            };

            $slider->delete();
        }

        return redirect()->route('slider.index')->with('success','Banner has been delete successfully');
    }

    // Slider status on / off button
    public function sliderStatus(Request $request){
        $HomeSliders  = HomeSlider::find($request->slider_id);
        $HomeSliders->status = $request->slider_status;
        $HomeSliders->save();

        return response()->json($HomeSliders);
    }
}
