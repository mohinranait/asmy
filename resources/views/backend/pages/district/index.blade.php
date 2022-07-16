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
                           <p class="tx-uppercase mb-0"> District Create</p>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div>
                                <form action="{{route('district.store')}}" method="POST">
                                    @csrf 
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Name">
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
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php $i = 1 @endphp
                                        @foreach( $districts as $key)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $key->name }}</td>
                                           
                                            <td> <input type="checkbox" class="toggle-class" data-id="{{ $key->id }}" data-toggle="toggle" data-style="slow" data-on="Enabled" data-off="Disabled" data-size="small" data-onstyle="success" data-offstyle="danger" data-weight="70" {{ $key->status == true ? 'checked' : ''}} ></td>
                                            <td class="action">
                                            
                                                <a href="{{route('district.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delDis{{$key->id}}"><i class="fa fa-trash "></i></a>
                                                <!-- delete model start -->
                                                <div class="modal fade" id="delDis{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="{{route('district.destroy', $key->id)}}" method="POST" >
                                                        @csrf 
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title" id="exampleModalLabel">{{$key->name}} District Delete?</h6>
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

                                {{ $districts->links()}}
                        
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
        let dis_status = $(this).prop('checked') == true ? 1 : 0;
        let district_id = $(this).data('id');

        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:"{{ route('district.status') }}",
            data:{
                'dis_status' : dis_status,
                'district_id' : district_id,
            },
        })
    })
</script>

@endsection