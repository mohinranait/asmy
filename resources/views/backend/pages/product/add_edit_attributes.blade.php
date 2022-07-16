@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Product Attirbutes</title>
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
                        <div class="card mb-3" >
                            <div class="card-header tx-medium">
                            <p class="tx-uppercase mb-0">Product Attirbutes</p>
                            </div><!-- card-header -->
                            <div class="card-body">

                                <div class="mb-5">

                                    <form action="{{ route('product.attribute.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf  
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <strong for=""> Product Name </strong>:
                                                    {{$product['name']}}
                                                </div>
                                                <div class="form-group">
                                                    <strong for="">Product Code</strong>
                                                    {{ $product['unique_id']}}
                                                </div>
                                            
                                                <div class="form-group">
                                                    <strong for="">Product Proce</strong> : 
                                                    @if( $product->offer_price)
                                                        {{ $product->offer_price}} TK
                                                    @else
                                                        {{ $product['regular_price']}} TK
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <img src="{{asset('image/'. $product['main_image'])}}" width="120px;" alt="">
                                                </div>
                                                <div class="row ">
                                                    <div class="col-lg-8 m-auto">
                                                        <div class="form-group">
                                                            <div class="field_wrapper">
                                                                <div>
                                                                    <input type="text" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="color[]" placeholder="Color" required/>
                                                                    <input type="text" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="sku[]" placeholder="Sku" required/>
                                                                    <input type="number" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="stock[]" placeholder="Stock" />
                                                                    <a href="javascript:void(0);" class="add_button btn btn-primary " title="Add attibute">Add</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="submit" class="btn btn-info " value="Save Attribute" width="220px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <h4>Product Attributes</h4>
                                    <form action="{{route('attribute.update')}}" method="POST" >
                                        @csrf 
                                        <table class="table table-bordered table-hover border mb-2 mg-b-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    ID
                                                    </th>
                                                    <th>Color</th>
                                                    <th>SKU</th>
                                                    <th>Stock</th>
                                                   
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach( $product->productAttribute as $key)
                                                <input type="text" style="display:none" name="attributeId[]" value="{{$key->id}}">
                                                <tr>
                                                    <td style="font-size:13px;">
                                                        {{ $i }} 
                                                    </td>
                                                

                                                    <td style="font-size:13px;">
                                                        
                                                        <input type="text" name="color[]" value="{{ $key->color }}" style="width:100px;">
                                                    </td>

                                                 
                                                    <td style="font-size:13px;">
                                                        <input type="text" name="sku[]" value="{{ $key->sku }}" style="width:100px;">
                                                    </td>

                                                    <td style="font-size:13px;">
                                                        <input type="text" name="stock[]" value="{{ $key->stock }}" style="width:100px;">
                                                    </td>

                                                    <td>
                                                    <a href="{{route('attribute.delete', $key->id )}}" class="btn btn-danger btn-sm"> <i class="fa fa-trash "></i> DELETE</a>
                                                    </td>
                                                </tr>
                                                @php $i++ @endphp
                                                @endforeach
                                            
                                            </tbody>
                                        </table>
                                        <input type="submit" class="btn btn-primary" value="update attribute">
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script src="{{asset('backend/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>
<script>
        CKEDITOR.replace( 'descriptionid' );
</script>



<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="color[]" placeholder="Color" required/>  <input type="text" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="sku[]" placeholder="sku" required/>   <input type="number" class="form-control" style="width:120px ;margin-right:10px; margin-bottom:10px; display:inline-block;" name="stock[]" placeholder="stock" required/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>




@endsection