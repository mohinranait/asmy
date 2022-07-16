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
        .imageFile{
            width:88px;
            margin-right:20px;
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
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="br-pagebody pt-4">
                <div class="row row-sm ">
                    <div class="col-sm-6 col-xl-12">
                        <div class="card mb-3" >
                            <div class="card-header tx-medium d-flex justify-content-between">
                            <p class="tx-uppercase mb-0">Product Create</p>
                            <a href="{{route('product.index')}}" class="btn btn-primary btn-sm"> Product List</a>
                            </div><!-- card-header -->
                            <div class="card-body">
                               <div class="form-group">
                                    <label for="">Product Title <sup style="color:red">*</sup></label> 
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Product name" >
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                               </div>
                               <div class="form-group">
                                    <label for="">Product Description</label>
                                   <textarea name="descriptionid" id="" cols="30" rows="10"></textarea>
                               </div>
                               
                            </div><!-- card-body -->
                        </div>
                        <div class="card mb-3" >
                           
                            <div class="card-body">
                           
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Price <sup style="color:red">*</sup></label>
                                            <input type="number" name="regular_price" class="form-control" placeholder="Price">
                                            @error('price')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Offer Price</label>
                                             <input type="number" name="offer_price" class="form-control" placeholder="Offer Price">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Fiture Product</label>
                                            <select class="form-control " name="is_fiture"  >
                                                <option value="0" >Fiture Product</option>
                                                <option value="1">Active</option>
                                                <option value="0">In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Primary Category <sup style="color:red">*</sup></label>
                                            <select class="form-control " name="category_id" id="productPrimaryCatIdFind">
                                                <option value="">Primary Category</option>
                                                @foreach( $categorys as $key)
                                                <option value="{{$key->id}}">{{$key->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Sub Category <sup style="color:red">*</sup></label>
                                            <select class="form-control " name="sub_category_id" id="subCatWithParent">
                                                <option value="">Select sub category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Brand </label>
                                            <select class="form-control " name="brand_id">
                                                <option value="">Select Brand</option>
                                                @foreach( $brands as $key)
                                                <option value="{{$key->id}}">{{$key->name}}</option>
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
                                                    <option value="1">Active</option>
                                                    <option value="0">In-active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Unique ID <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="text" name="unique_id" class="form-control" placeholder="SKU">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Stock <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <input type="number" name="quentity" class="form-control" placeholder="Quentity">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Product Thumnail</label>
                                            <div>
                                                <input type="file" class="imageFile" name="main_image" accept=".png, .jpg," onchange="mainimage(this);" >
                                                <img id="main_image" src="http://placehold.it/180" alt="your image" width="100px" />
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Gallary image</label>
                                            <div>
                                                <input type="file" name="gallary_one" class="imageFile" accept=".png, .jpg," onchange="gallaryone(this);">
                                                <img id="gallary_one" src="http://placehold.it/180" width="100px" />
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Gallary image</label>
                                            <div>
                                                <input type="file" name="gallary_two" class="imageFile" accept=".png, .jpg," onchange="gallarythree(this);" >
                                                <img id="cre_product_three"  src="http://placehold.it/180" alt="your image" width="100px"  alt="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Product Sort discription <sup style="color:red">*</sup></label>
                                            <div class="form-group d-flex justify-content-between">
                                                <textarea name="sort_discription" class="form-control" id="" cols="30" rows="2"></textarea>
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
                                    <input type="text" name="meta_title" class="form-control" value="{{old('name')}}" placeholder="Meta title" >
                               </div>
                               <div class="form-group">
                                    <label for="">Meta Descrition</label>
                                    <textarea name="meta_discription" class="form-control" id="" cols="30" rows="2"></textarea>
                               </div>
                               <div class="form-group mb-5">
                                    <label for="">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" value="asmy bd," data-role="tagsinput">
                               </div>

                               <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group ">
                                            <input type="submit" value="Save and Publist" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- card-body -->
                            
                        </div>
                    </div><!-- col-3 -->
                  
                    
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

        $(document).ready(function(){
            $('#productPrimaryCatIdFind').on("change" , function(e){
                e.preventDefault();
                var primaryCategory_id = $('#productPrimaryCatIdFind').val();
                // alert(primaryCategory_id)
                if( primaryCategory_id ){
                    $.ajax({
                        url: "/primary/category/find/with-sub-category/" + primaryCategory_id,
                        type:'GET',
                        dataType:"json",

                        success:function(data){
                            $("#subCatWithParent").empty();
                            $('#subCatWithParent').html('<option value="">Select your sub category</option>');
                            $.each(data, function(key,value){
    
                                $("#subCatWithParent").append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                        }

                    })
                }
            })
        })

    </script>

    <script>
        // Gallafy image three upload
        function mainimage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#main_image')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Gallary image two upload
        function gallaryone(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#gallary_one')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Gallafy three 
        function gallarythree(input){
            
            if( input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                     $("#cre_product_three").attr('src' , e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

  

@endsection