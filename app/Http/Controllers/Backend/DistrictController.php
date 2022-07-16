<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\District;


class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::orderby('name','asc')->paginate(7);
        return view('backend.pages.district.index',compact('districts'));
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
            'name' => ['required', 'string', 'unique:districts'],
        ]);


        $district = new District();
        $district->name = $request->name;
        $district->slug = Str::slug($request->name);
        $district->status = $request->status;

        $district->save();
        return redirect()->back()->with('success', 'Save Successfully');
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
        $district = District::find($id);
        if( $district){
            return view('backend.pages.district.edit',compact('district'));
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
            "name" => 'required|unique:districts,name,'.$id,
        ]);

        $district = District::find($id);
        $district->name = $request->name;
        $district->slug = Str::slug($request->name);
        $district->status = $request->status;

        $district->save();
        return redirect()->route('district.index')->with('success', 'Update Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        if( $district){
            $district->delete();
        }
        return redirect()->route('district.index')->with('success', 'Delete Successfully');
    }


    // District Status
    public function districtStatus(Request $request){
        $district = District::find($request->district_id);
        $district->status = $request->dis_status;
        $district->save();
        return response()->json([
            'success' => "Status Change Successfully",
        ]);
    }
}
