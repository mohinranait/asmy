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
                    <div class="card mb-4">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> Slider</p>
                               
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                           <div>
                                <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="main_title" value="{{old('main_title')}}" placeholder="Title" maxlength="58" class="form-control">
                                                @error('main_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Sub Title</label>
                                                <input type="text" name="sub_title" value="{{old('sub_title')}}" placeholder="Sub title" maxlength="18" class="form-control">
                                            </div>
                                        </div>

                                    
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Button Link</label>
                                                <input type="text" name="link" value="{{old('link')}}" placeholder="Link" class="form-control">
                                                @error('link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                 
                                        <div class="col-lg-6">   
                                           
                                            <div class="form-group">
                                                <input type="file" name="banner">
                                                @error('banner')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group text-right">
                                               <input type="submit" class="btn btn-info" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                           </div>
                        
                        </div><!-- card-body -->
                    </div>
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-12 mb-5">
                    <div class="card">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> Slider</p>
                               
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                           <div>
                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <td>SI</td>
                                            <td>Title</td>
                                            <td>Sub Title</td>
                                            <td>Price</td>
                                            <td>image</td>
                                            <td>status</td>
                                            <td>Actiion</td>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        @php $i = 1; @endphp
                                        @foreach($sliders as $key)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $key->main_title }}</td>
                                            <td>{{ $key->sub_title }}</td>
                                            <td>{{ $key->price }}</td>
                                            <td>
                                                <a href="{{ $key->link }}">
                                                    @if( $key->banner)
                                                    <img src="{{asset('image/' . $key->banner)}}" style="width:60px;" alt="">
                                                    @endif
                                                </a>
                                               
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="sliderStatusInput" data-id="{{ $key->id }}" {{ $key->status == true ? 'checked' : ''}}  >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="px-2">
                                               
                                                <a href="{{route('slider.edit' , $key->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('slider.destroy', $key->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                               
                                            </td>
                                        </tr>
                                        @php $i++ ; @endphp
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

// Slider Status on / off js code start
$(".sliderStatusInput").on('change', function(e){
    let slider_status = $(this).prop('checked') == true ? 1 : 0;
    let slider_id = $(this).data('id');

    $.ajax({
        type:"GET",
        dataType:"JSON",
        url:"{{route('slider.status')}}",
        data:{
            'slider_status' : slider_status,
            'slider_id' : slider_id,
        },
        success:function(res){
            alert("Slider status has been changed"); 
        }
    })
})
// Slider Status on / off js code end


   
</script>


@endsection