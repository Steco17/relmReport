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
              <li class="breadcrumb-item active">Users</li>
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
        <form class="form-group" name="packageForm" id="packageForm" @if(empty($userData['id'])) action="{{ url('admin/add-edit-user') }}" @else action="{{ url('admin/add-edit-user/'.$userData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
	                    <label for="package_name">Name</label>
	                    <input type="text" class="form-control" id="name" name="name" placeholder=" Enter Name" @if(!empty($userData['name'])) value="{{ $userData['name'] }}" @else value="{{ old('name') }}" @endif>
	                  </div>
	                <!-- /.form-group -->
	              </div>

	                <div class="col-md-6">
                        <div class="form-group">
                             <label for="email">Email</label>
                             <input type="text" class="form-control" id="email" name="email" placeholder=" Enter email" @if(!empty($userData['email'])) value="{{ $userData['email'] }}" @else value="{{ old('email') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="mobile">Phone Number</label>
                             <input type="text" class="form-control" id="mobile" name="mobile" placeholder=" Enter Phone Number" @if(!empty($userData['mobile'])) value="{{ $userData['mobile'] }}" @else value="{{ old('mobile') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="address">Address</label>
                             <input type="text" class="form-control" id="address" name="address" placeholder=" Enter address" @if(!empty($userData['address'])) value="{{ $userData['address'] }}" @else value="{{ old('address') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="city">City</label>
                             <input type="text" class="form-control" id="city" name="city" placeholder=" Enter City" @if(!empty($userData['city'])) value="{{ $userData['city'] }}" @else value="{{ old('city') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <label for="state">State</label>
                             <input type="text" class="form-control" id="state" name="state" placeholder=" Enter state" @if(!empty($userData['state'])) value="{{ $userData['state'] }}" @else value="{{ old('state') }}" @endif>
                           </div>
                        <!-- /.form-group -->
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Admin Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" @if(!empty($userData['password'])) value="{{ $userData['password'] }}" @else value="{{ old('password') }}" @endif required>
                        </div>
                    </div>
                    </div>

	                <div class="col-md-6">
	                    <div class="form-group">
                            <label for="image">Profile Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <div>(Recommended size : Width:1040px, Height: 1020px)</div>
                            @if(!empty($userData['image']))
                                <div><img style="width: 60px; margin-top: 5px;" src="{{ asset('images/user_images/small/'.$userData['image']) }}">&nbsp;
                                    <a  class="confirmDelete" href="javascript:void(0)" record="user-image" recordid="{{ $userData['id'] }}">Delete Image</a>
                                </div>
                            @endif

	                    </div>
	                </div>


                        <div class="col-md-6 ">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="checkbox" name="status" id="status" value="Yes"
                            @if(!empty($productData['status']) && $productData['status'] == "Yes") checked @endif>
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
