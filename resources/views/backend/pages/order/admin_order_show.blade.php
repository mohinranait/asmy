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
                    <div class="card mb-4">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> District Information</p>
                                
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="row">

                            
                            <div class="col-lg-4">
                                    <div class="order-summary">
                                        <h6>User Information</h6>
                                        <p>Name : {{$order->name}}</p>
                                        <p>Email : {{ $order->email}}</p>
                                        <p>Phone : {{$order->phone}}</p>
                                    </div>
                            </div>

                            <div class="col-lg-4">
                                    <div class="order-summary">
                                        <h6>Order Status</h6>
                                        <p class="mb-1"><span>P.M.</span> :@if( $order->payment_method == 1) Bkash @elseif( $order->payment_method == 2) Nagad @else -N/A- @endif</p>
                                        <p class="mb-1"><span>TxitID</span> : {{ $order->transaction_id ? $order->transaction_id : '-N/A-' }}</p>
                                        <p class="mb-1"><span>Total Price</span>  : {{$order->total_price}} BDT</p>
                                        <p class="mb-1"><span>Status</span> :
                                            @if( $order->status == 1)
                                                Delevery
                                            @elseif(  $order->status == 2 )
                                                Cancel
                                            @elseif(  $order->status == 3 )
                                                Proccessing
                                            @elseif(  $order->status == 0 )
                                                Pending
                                            @endif
                                        </p>
                                        <p class="mb-1"><span>OrderID</span> : {{$order->id }}</p>
                                    </div>
                            </div>

                            <div class="col-lg-4">
                                    <div class="order-summary">
                                        <h6>Shopping Address</h6>
                                        <p>Address : {{ $order->address}}</p>
                                        <p>Zila : {{ $order->districtName->name}}</p>
                                        <p>Upzila : {{ $order->upzilas->name }}</p>
                                    </div>
                            </div>
                           </div>
                        
                        </div><!-- card-body -->
                    </div>
                    <div class="card mb-5">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> Order Information</p>
                                <a href="{{route('order.edit' , $order->id)}}" class="btn btn-info btn-sm">ORDER EDIT</a>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="order-item">
                                        <table class="table border table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Image </th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach( $carts as $key)
                                                <tr>
                                                    <th>{{ $i }}</th>
                                                    <td>
                                                        <a href="{{route('products' , $key->products->slug)}}">{{$key->products->name}}</a> <br>
                                                        ID : {{ $key->products->unique_id}} <br>
                                                        @if( $key->attribute )
                                                            Color : {{ $key->attribute }}
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        <img src="{{asset('image/' . $key->products->main_image )}}" style="width:60px" alt="">
                                                    </td>
                                                    <td>{{$key->unit_price}} BDT</td>
                                                    <td>{{$key->cart_qty}} Psc</td>
                                                    <td>{{ $key->unit_price * $key->cart_qty  }} BDT</td>
                                                </tr>
                                                @php $i++ ; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                        </div><!-- card-body -->
                    </div>
                </div><!-- col-3 -->
            </div><!-- row -->
        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->


@endsection

@section('js')


@endsection