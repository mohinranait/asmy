<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\District;
use App\Models\Upzila;

class UpzilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upzilas = Upzila::orderby('name','asc')->paginate(7);
        $districts = District::orderby('name','asc')->where('status',1)->get();
        return view('backend.pages.upzila.index',compact('upzilas','districts'));
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
            'name' => ['required', 'string', 'unique:upzilas'],
            'district_id' => ['required'],
        ],[
            'name.required' => 'Upzila name required',
            'district_id.required' =>'This fild required',
        ]);

        $upzila = new Upzila();
        $upzila->name = $request->name;
        $upzila->slug = Str::slug($request->name);
        $upzila->district_id = $request->district_id;
        $upzila->status = $request->status;
        $upzila->save();
        return back()->with('success', 'Create Successfully');
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
        $upzila = Upzila::find($id);
        if( $upzila){
            $districts = District::orderby('name','asc')->where('status',1)->get();
            return view('backend.pages.upzila.edit' , compact('upzila','districts'));
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
            "name" => 'required|unique:upzilas,name,'.$id,
            "district_id" => 'required',
            
        ],[
            'name.required' => 'Upzila name required',
            'district_id.required' =>'This fild required',
        ]);

        $upzila = Upzila::find($id);
        $upzila->name = $request->name;
        $upzila->slug = Str::slug($request->name);
        $upzila->district_id = $request->district_id;
        $upzila->status = $request->status;
        $upzila->save();
        return redirect()->route('upzila.index')->with('success', 'Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upzila = Upzila::find($id);
        if( $upzila ){
            $upzila->delete();
        }
        return redirect()->route('upzila.index')->with('success', 'Delete Successfully');
    }

    // upzila Status
    public function upzilaStatus(Request $request){
        $upzila = Upzila::find($request->upzila_id);
        $upzila->status = $request->upzila_status;
        $upzila->save();
        return back()->with('success', 'Status change Successfully');
    }

    // upzila keyup search
    public function upzilaKeyup(Request $request){
        $upzilas = Upzila::orWhere('name',"LIKE","%" . $request->upzila_id . "%")->orderby('name','asc')->paginate(7);
        if( $upzilas->count() >= 1 ){
            return view('backend.pages.upzila.keyup',compact('upzilas'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
    }
}
