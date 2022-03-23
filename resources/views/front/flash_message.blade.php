@if ($errors->any())
	<div class="alert alert-danger" style="margin-top: 1px;">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	     </ul>
	</div>
 @endif
@if ($message = Session::get('success_message'))
<div class="alert alert-success alert-dismissible " role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error_message'))
<div class="alert alert-danger alert-dismissible " role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning_message'))
<div class="alert alert-warning alert-dismissible " role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info_message'))
<div class="alert alert-info alert-dismissible " role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Please check the form below for errors
</div>
@endif
