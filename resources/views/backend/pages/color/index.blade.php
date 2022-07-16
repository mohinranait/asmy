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
        .color-div{
            width:35px;
            height:35px;
            border-radius:4px;
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
            @if (\Session::has('info'))
            <div class="alert " style="background:#bd2130">
                {!! \Session::get('info') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row row-sm ">
                
                <div class="col-sm-6 col-xl-3">
    

                    <div class="card">
                        <div class="card-header tx-medium">
                           <p class="tx-uppercase mb-0"> Color Create</p>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div>
                                <form action="{{route('color.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input class="form-control" name="name" placeholder="Name" value="{{old('name')}}" type="text">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Color Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="color_img" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="">Color Code</label>
                                               <input type="text" name="color_code" class="form-control"  placeholder="Color code" value="#">
                                            
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            
                                        </div>
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
                <div class="col-sm-6 col-xl-9">
                    <div class="card">
                        <div class="card-header tx-medium ">
                            <div class="d-flex justify-content-between">
                                <p class="tx-uppercase mb-0"> Color List</p>
                                <div class="form-group m-0">
                                    <span>Search</span>
                                    <input type="text" id="colorKeyup">
                                </div>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div class="color-table">


                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $colors as $key)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $key->name }}</td>
                                            <td>
                                                @if($key->color_img)
                                                <img src="{{asset('image/' . $key->color_img)}}" width="35px" alt="">
                                                @else
                                                <div class="color-div" style="background: {{$key->color_code}} "></div> 
                                                @endif
                                            </td>
                                            <td>
                                                @if( $key->color_code)
                                                    {{ $key->color_code}}
                                                @else
                                                    Image
                                                @endif
                                            </td>
                                            <td> <input type="checkbox" class="toggle-class" data-id="{{ $key->id }}" data-toggle="toggle" data-style="slow" data-on="Enabled" data-off="Disabled" data-size="small" data-onstyle="success" data-offstyle="danger" data-weight="70" {{ $key->status == true ? 'checked' : ''}} ></td>
                                            <td class="action">
                                            
                                                <a href="{{route('color.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#colorDel{{$key->id}}"><i class="fa fa-trash "></i></a>
                                                <!-- delete model start -->
                                                <div class="modal fade" id="colorDel{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="{{route('color.destroy', $key->id)}}" method="POST" >
                                                        @csrf 
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title" id="exampleModalLabel">{{$key->name}} color Delete?</h6>
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

                                {{ $colors->links() }}
                        
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
        let color_status = $(this).prop('checked') == true ? 1 : 0;
        let color_id = $(this).data('id');

        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:"{{route('color.status')}}",
            data:{
                'color_status' : color_status,
                'color_id' : color_id,
            },
        })
    })
</script>

<script>
    $(document).ready(function(){
        $("#colorKeyup").on('keyup' , function(e){
            e.preventDefault();
            let color_id = $("#colorKeyup").val();
            // console.log(color_id);
            $.ajax({
                method:"GET",
                url: "{{route('color.keyup')}}",
                data:{color_id : color_id},
                success:function(res){
                    $('.color-table').html(res);
                    if( res.status == "nothing"){
                        $('.color-table').html("<div class=' alert alert-info text-center'>"+ 'No Data found' + " </div>")
                    }
                }
            })
        })
    })
</script>

<script>
    $('#colorpicker').spectrum({
  color: '#17A2B8'
});
</script>

@endsection