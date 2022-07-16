                      
                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $categorys as $key)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $key->name }}</td>
                                            <td>
                                                @if($key->image)
                                                <img src="{{asset('image/' . $key->image)}}" width="40px" alt="">
                                                @else
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
                                            
                                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash "></i></a>
                                                
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $categorys->links() }}