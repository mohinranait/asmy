<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\District;
use App\Models\Upzila;
use Image;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('name','asc')->get();
        return view('backend.pages.user.index',compact('users'));
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
        $user = User::find($id);
        if( $user){
            $districts = District::orderby('name','asc')->get();
            $upzilas = Upzila::orderby('name','asc')->get();
            return view('backend.pages.user.edit_user',compact('user','districts','upzilas'));
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
        $user = User::find($id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->district     = $request->district;
        $user->upzila       = $request->upzila;
        $user->status       = $request->status;
        $user->role         = $request->role;

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

        return redirect()->route('user.index')->with('success','Account has been update Successfully');
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


    // admin user update and district wish upzila find
    public function adminUserUpdateDistrict(Request $request , $id){
        $upzilas = Upzila::where('district_id', $id)->get();
        return response()->json($upzilas);
    }
}
