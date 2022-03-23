@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <category class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Packages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Packages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </category>

    <!-- Main content -->
    <category class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories</h3>
                <a href="{{ url('admin/add-edit-package') }}" style="max-width:150px; float: right;display: inline-block; " class="btn btn-block btn-success">Add Packages</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="Packages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Package Code</th>
                    <th>Destination State</th>
                    <th>Destination City</th>
                    <th>Package Image</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Status(s)</th>
                    <th>Action(s)</th>

                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($Packages as $package)

                  <tr>
                    <td>{{$package->id}}</td>
                    <td>{{$package->package_name}}</td>
                    <td>{{$Package->Package_code}}</td>
                    <td>{{$product->destination_state}}</td>
                    <td>{{$product->destination_city}}</td>
                    <td>
                        <?php $product_image_path = "images/product_images/small/".$product->main_image;  ?>
                        @if (!empty($product->main_image) && file_exists($product_image_path ))
                            <img style="width: 100px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}">
                        @else
                            <img style="width: 100px;" src="{{ asset('images/product_images/small/default_image.png') }}">

                        @endif

                    </td>
                    <td>{{$product->category->category_name}}</td>
                    <td>{{$product->section->name}}</td>
                    <td>
                    	@if($product->status ==1)
                    		<a class="updatePackagestatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">Active</a>
                    	@else
                			<a class="updatePackagestatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">Inactive</a>
                		@endif
                	</td>
                     <td style="width: 120px ;">
                      <a title="Add Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a> &nbsp;
                      <a title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-plus-circle"></i></a> &nbsp;
                      <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a> &nbsp;
                      <a title="Delete Product" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}" <?php /* href="{{ url('admin/delete-category/'.$category->id) }}"*/?>><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </category>
    <!-- /.content -->
  </div>
@endsection
