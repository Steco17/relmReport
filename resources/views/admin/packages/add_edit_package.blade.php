@extends('layouts.admin_layout.admin_layout')
@section('content')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class=" ">
            <h1>Package</h1>
          </div>
          <div class=" ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	@if ($errors->any())
            <div class="alert alert-danger" style="margin-top: 1px;">
                <ul>
            	    @foreach ($errors->all() as $error)
                 	    <li>{{ $error }}</li>
                    @endforeach
                 </ul>
            </div>
        @endif
         @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                  {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form class="form-group" name="packageForm" id="packageForm" @if(empty($packageData['id'])) action="{{ url('admin/add-edit-package') }}" @else action="{{ url('admin/add-edit-package/'.$packageData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
	        <div class="card card-default">
	          <div class="card-header">
	            <h3 class="card-title">{{$title}}</h3>

	            <div class="card-tools">
	              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
	            </div>
	          </div>

	          <div class="card-body">
	            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Select</option>
                                @foreach ($categories as $section )
                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                    @foreach ($section['categories'] as $category)
                                        <option value="{{ $category['id'] }}" @if(!empty(@old('category_id'))
                                        && $category['id'] ==@old('category_id')) selected @elseif (!empty($packageData['category_id']) && $packageData['category_id']==$category['id'])
                                        selected @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name'] }}</option>
                                    @endforeach
                                    @foreach ($category['subcategories'] as $subcategory)
                                        <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id'))
                                        && $subcategory['id'] ==@old('category_id')) selected @elseif (!empty($packageData['category_id']) && $packageData['category_id']==$subcategory['id'])
                                        selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;{{ $subcategory['category_name'] }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
	                </div>

                   
	              <div class="col-md-6">
	               <div class="form-group">
	                    <label for="package_name">Package Name</label>
	                    <input type="text" class="form-control" id="package_name" name="package_name" placeholder=" Enter Package Name" @if(!empty($packageData['package_name'])) value="{{ $packageData['package_name'] }}" @else value="{{ old('package_name') }}" @endif>
	                  </div>
	                <!-- /.form-group -->
	              </div>

	                <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_color">Package Color</label>
                             <input type="text" class="form-control" id="package_color" name="package_color" placeholder=" Enter Package Color" @if(!empty($packageData['package_color'])) value="{{ $packageData['package_color'] }}" @else value="{{ old('package_color') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_price">package Price</label>
                             <input type="text" class="form-control" id="package_price" name="package_price" placeholder=" Enter Package Price" @if(!empty($packageData['package_price'])) value="{{ $packageData['package_price'] }}" @else value="{{ old('package_price') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
	                <div class="col-md-6">
	            		<div class="form-group">
	                    <label for="package_content">Package Content (%)</label>
	                    <input type="text" class="form-control" id="package_content" name="package_content" placeholder=" Enter Package Content" @if(!empty($packageData['package_content'])) value="{{ $packageData['package_content'] }}" @else value="{{ old('package_content') }}" @endif>
	                  </div>
	            	</div>

                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_weight">Package Weight</label>
                             <input type="text" class="form-control" id="package_weight" name="package_weight" placeholder=" Enter Package Weight" @if(!empty($packageData['package_weight'])) value="{{ $packageData['package_weight'] }}" @else value="{{ old('package_weight') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_length">Package Length</label>
                             <input type="text" class="form-control" id="package_length" name="package_length" placeholder=" Enter Package Length" @if(!empty($packageData['package_length'])) value="{{ $packageData['package_length'] }}" @else value="{{ old('package_length') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_height">Package Height</label>
                             <input type="text" class="form-control" id="package_height" name="package_height" placeholder=" Enter Package Height" @if(!empty($packageData['package_height'])) value="{{ $packageData['package_height'] }}" @else value="{{ old('package_height') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="package_width">package Width</label>
                             <input type="text" class="form-control" id="package_weight" name="package_width" placeholder=" Enter Package Width" @if(!empty($packageData['package_width'])) value="{{ $packageData['package_width'] }}" @else value="{{ old('package_width') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>

	                <div class="col-md-6">
	                    <div class="form-group">
                            <label for="main_image">Package Main Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="main_image" id="main_image">
                                    <label class="custom-file-label" for="main_image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <div>(Recommended size : Width:1040px, Height: 1020px)</div>
                            @if(!empty($packageData['main_image']))
                                <div><img style="width: 60px; margin-top: 5px;" src="{{ asset('images/package_images/small/'.$packageData['main_image']) }}">&nbsp;
                                    <a  class="confirmDelete" href="javascript:void(0)" record="package-image" recordid="{{ $packageData['id'] }}">Delete Image</a>
                                </div>
                            @endif

	                    </div>
	                </div>


                    <div class="col-md-6">
	                    <div class="form-group">
                            <label for="package_video">package Video</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="package_video" id="package_video">
                                    <label class="custom-file-label" for="package_video">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>

                            </div>
                            @if(!empty($packageData['package_video']))
                                <div>
                                    <a href="{{ url('videos/package_videos/'.$packageData['package_video']) }}" >Download</a>&nbsp;|
                                    <a  class="confirmDelete" href="javascript:void(0)" record="package-video" recordid="{{ $packageData['id'] }}">Delete Video</a>
                                </div>
                            @endif
	                    </div>
	                </div>

                    <div class="col-md-6">
	            		<div class="form-group">
	                    <label for="description">package Description</label>
	                      <textarea class="form-control" id="package_description" name="package_description" rows="3" placeholder=" Enter Package Description" >@if(!empty($packageData['description']))  {{$packageData['description']}}  @else  {{old('description')}}  @endif</textarea>
	                  </div>

	            	</div>

                    <div class="col-md-6  ">
                        <div class="form-group">
                            <label>Select Region/State</label>
                            <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                                <option value="" selected="selected">Select Region</option>
                                @foreach ($StateArray as $state )
                                    <option value="{{ $state }}"
                                    @if(!empty($packageData['destination_state']) && $packageData['destination_state'] == $state) selected @endif>{{ $state }}</option>>{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
	                </div>

                    <div class="col-md-6  ">
                        <div class="form-group">
                            <label>City</label>
                             <input type="text" class="form-control" id="destination_city" name="destination_city" placeholder=" Enter Package Detination City" @if(!empty($packageData['destination_city'])) value="{{ $packageData['destination_city'] }}" @else value="{{ old('destination_city') }}" @endif>
                        </div>
	                </div>
	            	
                <div class="col-md-6  ">
	            		<div class="form-group">
	                    <label for="meta_title">Meta Title</label>
	                     <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter Meta Title">@if(!empty($productData['meta_title']))  {{$productData['meta_title']}}  @else  {{old('meta_title')}}  @endif</textarea>
	                  </div>
	            	</div>

                    <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter Meta Description" >@if(!empty($productData['meta_description']))  {{$productData['meta_description']}}  @else  {{old('meta_description')}}  @endif</textarea>
                        </div>
                        </div>
                        <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="meta_keywords">Is Feature</label>
                            <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                            @if(!empty($productData['is_featured']) && $productData['is_featured'] == "Yes") checked @endif>
                        </div>
	                </div>
                    <div class="col-md-6  ">
                        <div class="form-group">
                        <label for="meta_keywords">Meta keywords</label>
                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter Meta keywords">@if(!empty($productData['meta_keywords']))  {{$productData['meta_keywords']}}  @else  {{old('meta_keywords')}}  @endif</textarea>
                        </div>

	                </div>
	            </div>
	          </div>
	          <div class="card-footer">
	           <button type="submit" class="btn btn-primary">Submit</button>
	          </div>
	        </div>
        </form>
      </div>
    </section>
  </div>


@endsection
