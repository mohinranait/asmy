                                <table class="table table-bordered table-hover mb-2 mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                SI
                                                <br>
                                                ID
                                            </th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Fiture</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $products as $key)
                                        <tr>
                                            <td style="font-size:13px;">
                                                <strong>SI</strong> : {{ $i }} 
                                                <br>
                                                <strong>ID</strong> : {{ $key->unique_id}}
                                            </td>
                                            <td>
                                               <p class="m-0 text-dark"> {{ $key->name}}</p>
                                                <p class="m-0 text-dark" style="font-size:12px">
                                                    @if(  $key->offer_price )
                                                       <strong>OP.</strong>  {{$key->offer_price}} BDT,
                                                    @else
                                                        <strong>RP.</strong> {{ $key->regular_price }} BDT,
                                                    @endif

                                                    <strong>Brand.</strong>  {{$key->brands->name}} 
                                                </p>
                                            </td>

                                            <td style="font-size:13px;">
                                                {{ $key->primaryCategorys->name }} ,
                                                <br>
                                                {{ $key->subCategorys->name }}
                                            </td>
                                           
                                            
                                           
                                            <td>
                                                @if( $key->main_image  )
                                                <img src="{{ asset('image/' . $key->main_image) }}" alt="">
                                                @else
                                                -N/A-
                                                @endif
                                            </td>
                                          
                                            <td>
                                                @if( $key->is_fiture == 1)
                                                Active
                                                @else
                                                In-active
                                                @endif
                                            </td>
                                            <td>
                                            <label class="switch">
                                                <input type="checkbox" class="productStatusInput" data-id="{{ $key->id }}" {{ $key->status == true ? 'checked' : ''}}  >
                                                <span class="slider round"></span>
                                            </label>
                                            </td>
                                           
                                            <td>
                                                <a href="{{route('product.edit' , $key->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-edit "></i></a>
                                                <a href="{{route('product.attribute' , $key->id )}}" class="btn btn-warning btn-sm"><i class="fa fa-plus "></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delCat{{$key->id}}"><i class="fa fa-trash "></i></a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                      
                                    </tbody>
                                </table>




       