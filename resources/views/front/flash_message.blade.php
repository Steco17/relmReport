@if ($errors->any())
	<div class="alert alert-warning alert-dismissible fade show" style="margin-top: 1px;">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	     </ul>
	</div>
 @endif
@if ($message = Session::get('success_message'))
<div class="alert alert-success alert-dismissible  fade show" role="alert">
	 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error_message'))
<div class="alert alert-danger alert-dismissible  fade show" role="alert">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning_message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
	 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info_message'))
<div class="alert alert-info alert-dismissible  fade show" role="alert">
	 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger  fade show">
	 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	Please check the form below for errors
</div>
@endif
