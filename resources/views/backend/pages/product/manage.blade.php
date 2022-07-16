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
        td img{
            width:40px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 45px;
            height: 23px;
        }

        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 17px;
            width: 17px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(20px);
            -ms-transform: translateX(20px);
            transform: translateX(20px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
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
                                <p class="tx-uppercase mb-0"> Product List</p>
                                <div class="form-group m-0">
                                    <a href="{{route('product.create')}}" class="btn btn-primary btn-sm mx-5">Add Product</a>
                                    <span>Search</span>
                                    <input type="text" id="backendProductFind">
                                </div>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="backendproduct-table">

                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                SI
                                                <br>
                                                ID
                                            </th>
                                            <th>Name</th>
                                           
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Fiture</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $products as $key)
                                        <tr>
                                            <td style="font-size:13px;">
                                                <strong>SI</strong> : {{ $i }} 
                                                <br>
                                                <strong>ID</strong> : {{ $key->unique_id}}
                                            </td>
                                            <td>
                                               <p class="m-0 text-dark"> {{ $key->name}}</p>
                                                <p class="m-0 text-dark" style="font-size:12px">
                                                    @if(  $key->offer_price )
                                                       <strong>OP.</strong>  {{$key->offer_price}} BDT,
                                                    @else
                                                        <strong>RP.</strong> {{ $key->regular_price }} BDT,
                                                    @endif

                                                    <strong>Brand.</strong>  {{$key->brands->name}} 
                                                </p>
                                            </td>

                                            <td style="font-size:13px;">
                                                {{ $key->primaryCategorys->name }} ,
                                                <br>
                                                {{ $key->subCategorys->name }}
                                            </td>
                                           
                                            
                                           
                                            <td>
                                                @if( $key->main_image  )
                                                <img src="{{ asset('image/' . $key->main_image) }}" alt="">
                                                @else
                                                -N/A-
                                                @endif
                                            </td>
                                          
                                            <td>
                                                @if( $key->is_fiture == 1)
                                                Active
                                                @else
                                                In-active
                                                @endif
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="productStatusInput" data-id="{{ $key->id }}" {{ $key->status == true ? 'checked' : ''}}  >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                           
                                            <td>
                                                <a href="{{route('product.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="{{route('product.attribute' , $key->id )}}" class="btn btn-warning btn-sm"><i class="fa fa-plus "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delCat{{$key->id}}"><i class="fa fa-trash "></i></a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                      
                                    </tbody>
                                </table>

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
     $(".productStatusInput").on('change', function(e){
        let productStatus = $(this).prop('checked') == true ? 1 : 0;
        let productId = $(this).data('id');

        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:"{{route('product.status')}}",
            data:{
                'productStatus' : productStatus,
                'productId' : productId,
            },
            success:function(res){
                // 
            }
        })
    })


    // keyup search product
    $(document).ready(function(){
        $("#backendProductFind").on('keyup' , function(e){
            e.preventDefault();
            let product_string = $("#backendProductFind").val();
            // console.log(category_id);
            $.ajax({
                method:"GET",
                url: "{{route('backend.product.keyup')}}",
                data:{product_string : product_string},
                success:function(res){
                    $('.backendproduct-table').html(res);
                    if( res.status == "nothing"){
                        $('.backendproduct-table').html("<div class=' alert alert-info text-center'>"+ 'No Data found' + " </div>")
                    }
                }
            })
        })
    })
</script>


@endsection