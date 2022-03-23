@extends('layouts.admin_layout.admin_layout')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update admin details</h3>
              </div>
               @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top:10px;">
                  {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
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

              <!-- form validation -->

               @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 12px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


              <!-- form start -->
              <form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">@csrf
                <div class="card-body">
                 
                   <div class="form-group">
                    <label for="exampleInputEmail1">Adnin Email</label>
                    <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}"  placeholder="Enter email" readonly="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Adnin Type</label>
                    <input  class="form-control" value="{{ Auth::guard('admin')->user()->type }}"  placeholder="Enter email" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="current_pwd">Name</label>
                    <input type="text" id="admin_name" name="admin_name" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" id="current" placeholder="Enter Admin NAme">
                    <span id="chkCurrentPwd"></span>
                  </div>

                  <div class="form-group">
                    <label for="new_pwd">Mobile</label>
                    <input type="text" id="admin_mobile" name="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" class="form-control" placeholder="Enter Admin Mobile">
                  </div>

                 <div class="form-group">
                    <label for="admin_image">Image</label>
                    <div class="input-group">
                      <div class="custom-file">

                         <input type="file" class="form-control-file" id="admin_image" name="admin_image" accept="image/*">
                      </div>                      
                    </div>
                  </div>
                  <div class="form-group">                   
                    @if(!empty(Auth::guard('admin')->user()->image))
                      <a target="_blank" href="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                      <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                    @endif
                  </div>

                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>

@endsection