@extends('layouts.admin_layout.admin_layout')
@section('content')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package Images</li>
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
        @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">
                  {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form class="form-group" name="AddImageForm" id="AddImageForm" action="{{ url('admin/add-images/'.$packageData['id']) }}" method="post" enctype="multipart/form-data">@csrf

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
	                    <label for="Package_name">Package Name:</label>&nbsp; {{ $packageData['package_name'] }}
	                  </div>
	                <!-- /.form-group -->
	              </div>

	            </div>
	            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="Package_code">Package Code:</label>&nbsp;  {{ $packageData['destination_region'] }}
                           </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
	                    <div class="form-group">
                           <img style="width: 60px; margin-top: 5px;" src="{{ asset('images/Package_images/small/'.$packageData['main_image']) }}">&nbsp;

	                    </div>
	                </div>
	                <div class="col-md-6">
                        <div class="form-group">
                             <label for="Package_color">Package Color:</label>&nbsp;  {{ $packageData['destination_city'] }}
                           </div>
                        <!-- /.form-group -->
                    </div>

	            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="field_wrapper">
                                <div>
                                    <input id="size" type="file" id="images" name="images[]" value="" multiple required/>
                                  </div>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>

	          </div>
	          <div class="card-footer">
	           <button type="submit" class="btn btn-primary">Add images</button>
	          </div>
	        </div>
        </form>

        <form name="editeImageForm" id="editeImageForm" method="post" action="{{ url('admin/edit-image/'.$packageData['id']) }}">@csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Added images</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="Packages" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>status</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packageData['images'] as $image)
                            <input style="display: none;" type="text" name="attrId[]" value="{{ $image['id'] }}" required readonly>

                            <tr>
                                <td>{{$image['id']}}</td>
                                <td>
                                    <img style="width: 60px; margin-top: 5px;" src="{{ asset('images/Package_images/small/'.$image['images']) }}">

                                </td>
                                <td>
                                    @if($image['status'] ==1)
                                        <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Active</a>
                                    @else
                                        <a class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Inactive</a>
                                    @endif
                                </td>
                                <td>
                                    <a title="Delete image" href="javascript:void(0)" class="confirmDelete" record="image" recordid="{{ $image['id'] }}"><i class="fas fa-trash-alt"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update images</button>
                </div>

                <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </form>

      </div>
    </section>
  </div>


@endsection
