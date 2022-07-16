@extends('backend.layout.template') 

@section('title')
<title>Asmybd | Category page</title>
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
                    <div class="card">
                        <div class="card-header tx-medium">
                           <p class="tx-uppercase mb-0"> Edit category</p>
                        </div><!-- card-header -->
                        <div class="card-body">

                            <div>

                            <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf 
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Slug</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
                                            @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <p>The "slug" is the url-friendly version of them name. is is usually all lowercase and contains only letters , numbers , and hyphens.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Image</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                
                                            <img src="{{asset('image/' . $category->image)}}" width="30px" alt="">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                   
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile"><i class="fas fa-image"></i> Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <label class="rdiobox">
                                                <input name="status" value="1" type="radio"  @if( $category->status == 1) checked @endif >
                                                <span>Active</span>
                                            </label>
                                            <label class="rdiobox">
                                                <input name="status" value="0"  type="radio" @if( $category->status == 0) checked @endif>
                                                <span>In-Active</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group ">
                                          
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-9">
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-info btn-sm mg-b-10">Save & Update</button>
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

@endsection