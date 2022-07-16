@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Slider edit page</title>
@endsection

@section('css')

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
                                <p class="tx-uppercase mb-0">Edit Slider </p>
                               
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                           <div>
                                <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="main_title" value="{{ $slider->main_title ? $slider->main_title : old('main_title') }}" placeholder="Title" maxlength="58" class="form-control">
                                                @error('main_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Sub Title</label>
                                                <input type="text" name="sub_title" value="{{ $slider->sub_title ? $slider->sub_title : old('sub_title')}}" placeholder="Sub title" maxlength="18" class="form-control">
                                            </div>
                                        </div>

                                    
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Button Link</label>
                                                <input type="text" name="link" value="{{ $slider->link ? $slider->link : old('link')}}" placeholder="Link" class="form-control">
                                                @error('link')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="number" class="form-control" name="price" value="{{ $slider->price ? $slider->price : old('price')}}" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Select Status</option>
                                                    <option value="1" @if($slider->status == 1) selected @endif>Active</option>
                                                    <option value="0" @if($slider->status == 0) selected @endif>In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                 
                                        <div class="col-lg-6">   
                                           
                                            <div class="form-group">
                                                <input type="file" name="banner">
                                                <img src="{{asset('image/' . $slider->banner )}}" style="width:200px; margin-left:20px" alt="">
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
              
            </div><!-- row -->
        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->


@endsection

@section('js')




   
</script>


@endsection