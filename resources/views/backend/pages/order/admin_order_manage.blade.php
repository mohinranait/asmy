@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Category page</title>
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
                    <div class="card">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> District List</p>
                                
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="district-table">


                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Price</th>
                                            <th>TxtID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $i = 1 @endphp
                                        @foreach( $orders as $key)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->email }}</td>
                                            <td>{{ $key->phone }}</td>
                                            <td>{{ $key->total_price }}</td>
                                            <td>
                                                @if($key->transaction_id)
                                                {{$key->transaction_id}}
                                                @else
                                                -N/A-
                                                @endif
                                            </td>
                                           
                                            <td>
                                                @if( $key->status == 1)
                                                Delevery
                                                @elseif( $key->status == 2)
                                                Cancle
                                                @elseif( $key->status == 3)
                                                Prosessing
                                                @else
                                                Pending
                                                @endif
                                            </td>
                                            <td class="action" style="width:125px">
                                            
                                                <a href="{{route('order.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="{{route('order.show' , $key->id )}}" class="btn btn-warning btn-sm"><i class="fa fa-eye "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delDis{{$key->id}}"><i class="fa fa-trash "></i></a>
                                                <!-- delete model start -->
                                                <div class="modal fade" id="delDis{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="{{route('order.destroy', $key->id)}}" method="POST" >
                                                        @csrf 
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title" id="exampleModalLabel">{{$key->name}} order Delete?</h6>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            
                                                                <div class="modal-footer text-center">
                                                                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- delete model end -->
                                                
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                       
                                    </tbody>
                                </table>

                                {{ $orders->links()}}
                        
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