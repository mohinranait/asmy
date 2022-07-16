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
                                            <td>
                                                @if( $key->status == 1)
                                                    <button class="btn btn-sm btn-success">Active</button>
                                                @else
                                                <button class="btn btn-sm btn-danger">In-active</button>
                                                @endif 
                                            </td>
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