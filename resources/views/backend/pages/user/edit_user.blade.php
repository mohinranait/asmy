@extends('backend.layout.template') 

@section('title')
<title>Asmybd | admin user edit</title>
@endsection

@section('css')
    <style>
        table.table.table-bordered.table-hover.mg-b-0 {
            border: 1px solid #ddd;
        }
        .action{
            text-align: center;
            width: 92px;
        }
        label.btn.btn-danger.btn-sm.active.toggle-off {
            padding-left: 0;
        }
    </style>
@endsection
@section('content')

    <div class="br-mainpanel ">
        <!-- <div class="br-pagetitle">
            <i class="icon ion-ios-home-outline"></i>
            <div>
                <h4>Dashboard</h4>
                <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
            </div>
        </div> -->

        <div class="br-pagebody pt-4">
            <div class="row row-sm ">
               
                <div class="col-sm-6 col-xl-12">
                    <div class="card mb-5">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> User edit</p>
                                <a href="{{route('user.index')}}" class="btn btn-primary btn-sm">User List</a>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="update-user">
                                <form action="{{route('user.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label for="">Full Name</label>
                                                <input type="text" name="name" value="{{$user->name ? $user->name : old('name') }}" class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label for="">Email</label>
                                                <input type="email" name="email" value="{{$user->email ? $user->email : old('email') }}" class="form-control" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label for="">Phone</label>
                                                <input type="number" name="phone" value="{{$user->phone ? $user->phone : old('phone') }}" class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">

                                                <label for="">Address</label>
                                                <input type="text" name="address" value="{{$user->address ? $user->address : old('address') }}" class="form-control" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">District</label>
                                                <select name="district" class="form-control" id="adminUserUpdateDistrict">
                                                    <option value="">Select district</option>
                                                    @foreach( $districts as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == $user->district ) selected @endif >{{ $key->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Upzila</label>
                                                <select name="upzila" class="form-control" id="adminUserUpdateUpzila">
                                                    <option value="">Select upzila</option>
                                                    @foreach( $upzilas as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == $user->upzila ) selected @endif >{{ $key->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Select Status</option>
                                                    <option value="1" @if( $user->status == 1) selected @endif>Active</option>
                                                    <option value="0" @if( $user->status == 0) selected @endif>In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Role</label>
                                                <select name="role" class="form-control" id="">
                                                    <option value="0">User Role</option>
                                                    <option value="0" @if( $user->role == 0) selected @endif  >Normal User</option>
                                                    <option value="1" @if( $user->role == 1) selected @endif  >Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Profile</label> <br>
                                                <input type="file" name="profile" onchange="adminuserupdate(this);" >
                                                <img class="admin_user_update" src="{{ $user->profile ? asset('image/' . $user->profile ) :  asset('frontend/images/demo-user.png') }}" style="width:100px;height:100px" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                               <input type="submit" class="btn btn-info" value="update profile">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- card-body -->
                    </div>
                </div><!-- col-3 -->
            </div><!-- row -->
        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->


@endsection

@section('js')

    <script>

        $(document).ready(function(){
            $('#adminUserUpdateDistrict').on("change" , function(e){
                e.preventDefault();
                var user_update_district = $('#adminUserUpdateDistrict').val();
                // alert(district_find)
                if( user_update_district ){
                    $.ajax({
                        url: "/admin-user/update/district/" + user_update_district,
                        type:'GET',
                        dataType:"json",
                        success:function(data){
                            $("#adminUserUpdateUpzila").empty();
                            $('#adminUserUpdateUpzila').html('<option value="">Select your upzila</option>');
                            $.each(data, function(key,value){

                                $("#adminUserUpdateUpzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                        }
                    })
                }
            })
        })


        // user image update and realtime display
        function adminuserupdate(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.admin_user_update')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


@endsection