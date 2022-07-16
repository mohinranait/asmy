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
                <div class="col-sm-6 col-xl-4">
                    <div class="card">
                        <div class="card-header tx-medium">
                           <p class="tx-uppercase mb-0"> Category Create</p>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div>
                                <form action="{{route('sub.category.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="form-group">
                                        <label for="">Select Primary Category</label>
                                        <select name="primary_category_id" class="form-control" id="">
                                            <option value="">Primary Category</option>
                                            @foreach( $primCategory as $item)
                                            <option value="{{ $item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Sub Category Name</label>
                                        <input class="form-control" name="name" placeholder="Name" type="text">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <label class="rdiobox">
                                            <input name="status" value="1" type="radio" checked>
                                            <span>Active</span>
                                        </label>
                                        <label class="rdiobox">
                                            <input name="status" value="0" type="radio">
                                            <span>In-Active</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block mg-b-10">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- card-body -->
                    </div>
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-8">
                    <div class="card">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0">Sub Category List</p>
                                <div class="form-group m-0">
                                    <span>Search</span>
                                    <input type="text" id="backSubCategorykeyup">
                                </div>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                        <div class="sub-cat-table">


                            <table class="table table-bordered table-hover mb-2 mg-b-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>P.Category</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach( $subCategory as $key)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $key->name }}</td>
                                        <td>{{ $key->primaryCategory->name }}</td>
                                        <td>
                                            @if($key->image)
                                            <img src="{{asset('image/' . $key->image)}}" width="40px" alt="">
                                            @else
                                            -N/A-
                                            @endif
                                        </td>
                                        <td> <input type="checkbox" class="toggle-class" data-id="{{ $key->id }}" data-toggle="toggle" data-style="slow" data-on="Enabled" data-off="Disabled" data-size="small" data-onstyle="success" data-offstyle="danger" data-weight="70" {{ $key->status == true ? 'checked' : ''}} ></td>
                                        <td class="action">
                                        
                                                <a href="{{route('sub.category.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delCat{{$key->id}}"><i class="fa fa-trash "></i></a>
                                                <!-- delete model start -->
                                                <div class="modal fade" id="delCat{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="{{route('sub.category.destroy', $key->id)}}" method="POST" >
                                                        @csrf 
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title" id="exampleModalLabel">{{$key->name}} sub Category Delete?</h6>
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

                            {{ $subCategory->links() }}

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
  $(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  })
</script>
<script>
    $(".toggle-class").on('change', function(e){
        let cat_status = $(this).prop('checked') == true ? 1 : 0;
        let cat_id = $(this).data('id');

        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:"{{route('sub.category.status')}}",
            data:{
                'cat_status' : cat_status,
                'cat_id' : cat_id,
            },
            success:function(res){
                // 
            }
        })
    })
</script>

<script>
    $(document).ready(function(){
        $("#backSubCategorykeyup").on('keyup' , function(e){
            e.preventDefault();
            let category_id = $("#backSubCategorykeyup").val();
            // console.log(category_id);
            $.ajax({
                method:"GET",
                url: "{{route('sub.category.keyup')}}",
                data:{category_id : category_id},
                success:function(res){
                    $('.sub-cat-table').html(res);
                    if( res.status == "nothing"){
                        $('.sub-cat-table').html("<div class=' alert alert-info text-center'>"+ 'No Data found' + " </div>")
                    }
                }
            })
        })
    })
</script>

@endsection