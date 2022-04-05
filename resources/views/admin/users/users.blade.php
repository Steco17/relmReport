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
              <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">Users</h3>
                <a href="{{ url('admin/add-edit-user') }}" style="max-width:150px; float: right;display: inline-block; " class="btn btn-block btn-success">Add Employees</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="Packages" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Status(s)</th>
                    <th>Action(s)</th>

                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($users as $user)

                  <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        <?php $user_image_path = "images/user_images/small/".$user->image;  ?>
                        @if (!empty($user->image) && file_exists($user_image_path ))
                            <img style="width: 100px;" src="{{ asset('images/user_images/small/'.$user->image) }}">
                        @else
                            <img style="width: 100px;" src="{{ asset('images/user_images/small/default_image.png') }}">

                        @endif

                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->address}}, {{$user->city}}</td>
                    <td>
                    	@if($user->status ==1)
                    		<a class="updateUserstatus" id="user-{{$user->id}}" user_id="{{$user->id}}" href="javascript:void(0)">Active</a>
                    	@else
                			<a class="updateUserstatus" id="user-{{$user->id}}" user_id="{{$user->id}}" href="javascript:void(0)">Inactive</a>
                		@endif
                	</td>
                     <td style="width: 120px ;">
                      <a title="Edit User" href="{{ url('admin/add-edit-user/'.$user->id) }}"><i class="fas fa-edit"></i></a> &nbsp;
                      <a title="Delete User" href="javascript:void(0)" class="confirmDelete" record="user" recordid="{{ $user->id }}"><i class="fas fa-trash-alt"></i></a>
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
