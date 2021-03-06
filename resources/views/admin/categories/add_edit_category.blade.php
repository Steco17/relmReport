@extends('layouts.admin_layout.admin_layout')
@section('content') 


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogue</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
        <form class="form-group" name="categoryForm" id="categoryForm" @if(empty($categoryData['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categoryData['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
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
	                    <label for="category_name">Category Name</label>
	                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" @if(!empty($categoryData['category_name'])) value="{{ $categoryData['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
	                  </div>
	                <!-- /.form-group -->
	              </div>
	               <div class="col-md-6">
	                <div class="form-group">
	                  <label>Select Section</label>
	                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
	                    <option value="" selected="selected">Select</option>
	                   	@foreach($getSelection as $section)
	                   		<option value="{{$section->id}}" @if(!empty($categoryData['section_id']) && $categoryData['section_id']==$section->id) selected @endif>{{$section->name}}</option>
	                   	@endforeach
	                  </select>
	                </div>
	            </div>
	            </div>
	              <div class="row">
	              <div id="appendCategoriesLevel" class="col-md-6">
	              	@include('admin.categories.append_categories_level')
	              </div>
	                <div class="col-md-6">
	                <div class="form-group">
	                    <label for="category_image">Category Image</label>
	                    <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input" name="category_image" id="category_image">
	                        <label class="custom-file-label" for="category_image">Choose file</label>
	                      </div>
	                      <div class="input-group-append">
	                        <span class="input-group-text" id="">Upload</span>
	                      </div>
	                    </div>
	                      @if(!empty($categoryData['category_image']))
	                      	<div><img style="width: 60px; margin-top: 5px;" src="{{ asset('images/category_images/'.$categoryData['category_image']) }}">&nbsp;
	                      		<a  class="confirmDelete" href="javascript:void(0)" record="category-image" recordid="{{ $categoryData['id'] }}" <?php /*href="{{ url('admin/delete-category-image/'.$categoryData['id']) }}"*/?>>Delete Image</a>
	                      	</div>
	                      @endif
	                  </div>
	                  </div>
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
	                    <label for="category_discounts">Category Discount</label>
	                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount" @if(!empty($categoryData['category_discount'])) value="{{ $categoryData['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
	                  </div>
	            	</div>
	            	<div class="col-md-6">
	            		<div class="form-group">
	                    <label for="url">Category URL</label>                  
	                    <input type="text" class="form-control" id="url" name="category_url" id="category_url" placeholder="Enter Category URL" @if(!empty($categoryData['url'])) value="{{ $categoryData['url'] }}" @else value="{{ old('url') }}" @endif>
	                  </div>
	            	</div>
	            	
	            </div>
	            <div class="row">
	            	<div class="col-md-6">
	            		<div class="form-group">
	                    <label for="description">Category Description</label>
	                      <textarea class="form-control" id="category_description" name="category_description" rows="3" placeholder="Enter Category Description" >@if(!empty($categoryData['description']))  {{$categoryData['description']}}  @else  {{old('description')}}  @endif</textarea>
	                  </div>
	            		
	            	</div>
	            
	            		<div class="col-md-6">
	            		<div class="form-group">
	                    <label for="meta_title">Meta Title</label>
	                     <textarea class="form-control" id="meta_title" name="meta_title" rows="3" placeholder="Enter Meta Title">@if(!empty($categoryData['meta_title']))  {{$categoryData['meta_title']}}  @else  {{old('meta_title')}}  @endif</textarea>
	                  </div>
	            	</div>
	            	
	            	
	            </div>

	         
	            <div class="row">
	             <div class="col-md-6">
	                 <div class="form-group">
	                    <label for="meta_description">Meta Description</label>
	                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter Meta Description" >@if(!empty($categoryData['meta_description']))  {{$categoryData['meta_description']}}  @else  {{old('meta_description')}}  @endif</textarea>
	                  </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                   <label for="meta_keywords">Meta keywords</label>
	                    <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter Meta keywords">@if(!empty($categoryData['meta_keywords']))  {{$categoryData['meta_keywords']}}  @else  {{old('meta_keywords')}}  @endif</textarea>
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