@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Category page</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('backend/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('backend/lib/select2/css/select2.min.css')}}">
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
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            margin-left: -5px;
            color:white;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0085a9;
            padding: 1px 5px 1px 14px;
        }
        .selecColorCode{
            width:10px;
            height:10px;
            background:red;
        }
        .inputfiles{
           width:88px;
           margin-right:30px;
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
        <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="br-pagebody pt-4">
                <div class="row row-sm ">
                    <div class="col-sm-6 col-xl-12">
                        <div class="card mb-3" >
                            <div class="card-header tx-medium d-flex justify-content-between">
                                <p class="tx-uppercase mb-0">Product Edit</p>
                                <a href="{{route('product.index')}}" class="btn btn-primary btn-sm"> Product List</a>
                            </div><!-- card-header -->
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="">Product Title <sup class="text-danger">*</sup></label>
                                    <input type="text" name='name' class="form-control" value=" {{$product->name}} " required>
                                </div>

                                <div class="form-group">
                                    <textarea name="descriptionid" class="form-control" id="" cols="30" rows="10">{{$product->description}}</textarea>
                                </div>
                            </div><!-- card-body -->
                        </div>

                        <div class="card mb-3" >
                            <div class="card-header tx-medium">
                                <p class="tx-uppercase mb-0">Product Create</p>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Price <sup class="text-danger">*</sup></label>
                                            <input type="number" name='regular_price' class="form-control" value="{{$product->regular_price}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Offer Price (Optional)</label>
                                            <input type="number" name='offer_price' class="form-control" value="{{$product->offer_price}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fiture Product</label>
                                            <select name="is_fiture" class="form-control" id="">
                                                <option value="0">Select Fiture </option>
                                                <option value="1" @if($product->is_fiture == 1 ) selected @endif >Active</option>
                                                <option value="0" @if($product->is_fiture == 0 ) selected @endif >In-Active</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Category <sup class="text-danger">*</sup> </label>
                                            <select name="category_id" class="form-control" required id="">
                                                <option value="">Primary Category</option>
                                                @foreach( $categorys as $key)
                                                <option value="{{ $key->id }}" @if( $key->id == $product->category_id) selected @endif> {{ $key->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Sub Category</label>
                                            <select name="sub_category_id" class="form-control" id="">
                                                <option value="">Sub Category</option>

                                                @foreach( $sub_categorys as $item )
                                                <option value="{{$item->id}}" @if($item->id == $product->sub_category_id) selected @endif > {{ $item->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Brand <sup class="text-danger">*</sup></label>
                                            <select name="brand_id" class="form-control" required id="">
                                                <option value="">Brand</option>
                                                @foreach( $brands as $brand )
                                                <option value="{{ $brand->id }}" @if( $brand->id == $product->brand_id ) selected @endif>{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                               
                            </div><!-- card-body -->
                        </div>

                        <div class="card mb-3">
                            <div class="card-header tx-medium">
                                <p class="tx-uppercase mb-0"> Product List </p>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Product Status</label>
                                            <div class="form-group d-flex justify-content-between">
                                                <select name="status" class="form-control" id="">
                                                    <option value="1">Select status</option>
                                                    <option value="1" @if( $product->status == 1) selected @endif  >Active</option>
                                                    <option value="0" @if( $product->status == 0) selected @endif  >In-active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Unique ID <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="text" name="unique_id" class="form-control" value="{{ $product->unique_id}}" required placeholder="SKU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Stock <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="number" name="quentity" class="form-control" value="{{ $product->quentity}}" readdird placeholder="Quentity">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Product Thumnail <sup class="text-danger">*</sup></label>
                                            <div>

                                                <input type="file" class="inputfiles" name="main_image"  accept=".png, .jpg," onchange="editmainproduct(this);">
                                                @if( $product->main_image)
                                                <img id="editproductimg" src="{{asset('image/' . $product->main_image)}}" width="100px" />
                                                @else
                                                -N/A-
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Gallary image</label>
                                            <div>
                                                
                                                <input type="file" class="inputfiles" name="gallary_one" accept=".png, .jpg," onchange="editproducttwo(this);">
                                                @if( $product->gallary_one)
                                                <img id="edit_product_two" src="{{asset('image/' . $product->gallary_one)}}" width="100px" alt="">
                                                @else
                                                -N/A-
                                                @endif
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Gallary image</label>
                                            <div>
                                               
                                                <input type="file" class="inputfiles" name="gallary_two" accept=".png, .jpg," onchange="editproductthree(this);">
                                                @if( $product->gallary_two)
                                                <img id="edit_product_three" src="{{asset('image/' . $product->gallary_two)}}" width="100px" alt="">
                                                @else
                                                -N/A-
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Product Sort discription <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <textarea name="sort_discription" class="form-control" id="" cols="30" rows="2">{{ $product->sortDiscription}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- card-body -->
                        </div>

                        <div class="card mb-5">
                            <div class="card-header tx-medium">
                            <p class="tx-uppercase mb-0">SEO OPTION</p>
                            </div><!-- card-header -->
                            <div class="card-body">
                              
                               <div class="form-group">
                                    <label for="">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title ? $product->meta_title : old('meta_title')}}" placeholder="Meta title" >
                               </div>
                               <div class="form-group">
                                    <label for="">Meta Descrition</label>
                                    <textarea name="meta_discription" class="form-control" id="" cols="30" rows="2">{{ $product->meta_discription}}</textarea>
                               </div>
                               <div class="form-group mb-5">
                                    <label for="">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" value="{{ $product->meta_keyword }}" data-role="tagsinput">
                               </div>

                               <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <input type="submit" value="Update and Publist" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- card-body -->
                            
                        </div>
                       
                    </div><!-- col-12 -->
                  
                    
                </div><!-- row -->
            </div><!-- br-pagebody -->
        </form>
    </div><!-- br-mainpanel -->


@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script src="{{asset('backend/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>
<script>
        CKEDITOR.replace( 'descriptionid' );
</script>


    <script>

         // Gallafy image three upload
         function editmainproduct(input) {
           
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let str = $('#editproductimg').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

         // Gallafy image three upload
         function editproducttwo(input) {
           
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let str = $('#edit_product_two').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
         // Gallafy image three upload
         function editproductthree(input) {
           
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let str = $('#edit_product_three').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
     

    </script>

@endsection