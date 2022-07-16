@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Category page</title>
@endsection

@section('css')
    <style>
      
        .order-summary{
            border:1px solid #ddd;
            padding:10px 8px;
            border-radius:4px;
            min-height: 165px;
        }
      
        .order-summary p span{
            width: 72px;
            display: inline-block;
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
                                <p class="tx-uppercase mb-0"> Order Edit</p>
                                <a href="{{route('order.index') }}" class="btn btn-info btn-sm">ORDER LIST</a>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div>
                                <form action="{{route('order.update' , $order->id)}}" method="POST">
                                    @csrf 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control"  value="{{ $order->name ? $order->name : old('name') }}" placeholder="Full name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" name="email" class="form-control" value="{{ $order->email ? $order->email : old('email') }}"  placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $order->phone ? $order->phone : old('phone') }}"  placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" class="form-control" value="{{ $order->address ? $order->address : old('address') }}"  placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">District</label>
                                                <select name="district" class="form-control" id="adminOrderDistrict">
                                                    <option value=""> District</option>
                                                    @foreach( $districts as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == $order->district) selected @endif >{{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Upzila</label>
                                                <select name="upzila" class="form-control" id="adminOrderUpzila">
                                                    <option value=""> Upzila</option>
                                                    @foreach( $upzilas as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == $order->upzila) selected @endif >{{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">TxtID</label>
                                                <input type="text" name="transaction_id" value="{{ $order->transaction_id ? $order->transaction_id  : old('transaction_id')}}" class="form-control" placeholder="TxtID" >
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="text" name="total_price" class="form-control" value="{{ $order->total_price ? $order->total_price : old('total_price') }}"  placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">P.M</label>
                                                <select name="payment_method" class="form-control" id="">
                                                    <option value=""> Paymetn Method</option>
                                                    <option value="1" @if($order->payment_method == 1) selected @endif>Bkash</option>
                                                    <option value="2" @if($order->payment_method == 2) selected @endif>Nagad</option>
                                                    <option value="3" @if($order->payment_method == 3) selected @endif>Roket</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Paid</label>
                                                <select name="is_paid" class="form-control" id="">
                                                    <option value=""> Paid</option>
                                                    <option value="1" @if($order->is_paid == 1) selected @endif>COD</option>
                                                    <option value="2" @if($order->is_paid == 2) selected @endif>SSL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="0">Status</option>
                                                    <option value="0" @if($order->status == 0) selected @endif >Pending</option>
                                                    <option value="1" @if($order->status == 1) selected @endif >Delevery</option>
                                                    <option value="2" @if($order->status == 2) selected @endif >Cancel</option>
                                                    <option value="3" @if($order->status == 3) selected @endif >Proccessing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 ">
                                           <input type="submit" class="btn btn-info " value="Order Update" >
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
        $('#adminOrderDistrict').on("change" , function(e){
            e.preventDefault();
            var district_val = $('#adminOrderDistrict').val();
            // alert(district_val)
            if( district_val ){
                $.ajax({
                    url: "/admin/order/district/" + district_val,
                    type:'GET',
                    dataType:"json",

                    success:function(data){
                        $("#adminOrderUpzila").empty();
                        $('#adminOrderUpzila').html('<option value="">Select upzila</option>');
                        $.each(data, function(key,value){

                            $("#adminOrderUpzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }

                })
            }
        })
    })

</script>

@endsection