<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use Session;
use App\section;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    //
    public function categories(){
    		Session::put('page', 'category');
    	$categories = Category::with(['section','parentCategory'])->get(); 
    	// $categories = json_decode(json_encode($categories));
    	// echo "<pre>"; print_r($categories); die;

    	return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
    	if ($request->ajax()) {
    		# code...
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		if ($data['status']=="Active") {
    			# code...
    			$status = 0;
    		} else{
    			$status = 1;
    		}
    		Category::where('id', $data['category_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);

    	}
    }

    public function addEditCategory(Request $request, $id=null)
    {
    	if ($id=="") {
    		$title = 'Add Category';
    		# add category function
    		$category = new Category;
             $categoryData = array();
             $getCategories = array();
             $message = 'Category added sucessfully!';
    	}else{
    		$title = 'Edit Category';
    			# Edit category function
            $categoryData = Category::where('id',$id)->first();
            $categoryData = json_decode(json_encode($categoryData),true);
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$categoryData['section_id']])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
           // echo "<pre>"; print_r($getCategories); die;
            $category = Category::find($id);

           // echo "<pre>"; print_r($categoryData); die;
            $message = 'Category sucessfully updated!';

    	}

    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		//category rules
    		$rules = [
    				'category_name' => 'required',
    				'section_id' => 'required',
    				'category_url' => 'required',
    				'category_image' => 'image'
    			];

    				$customMessages = [
    					'category_name.required' => 'Category Name is require',
    					'section_id.required' => 'Section is require',
    					'category_url.required' => 'Category Url is require',
    					'category_image.image' => 'Valid Category image is require'

    				];

    			 $this->validate($request, $rules, $customMessages);

    		//upload image
    			 if ($request->hasFile('category_image')) {
    			 	# code...
    			 	$image_temp = $request->file('category_image');
    			 	if ($image_temp->isValid()) {
    			 		# code... het image extension
    			 		$extension = $image_temp->getClientOriginalExtension();
    			 		//generate Image Name
    			 		$imageName = rand(111,99999).'.'.$extension;
    			 		$imagePath = 'images/category_images/'.$imageName;
    			 		//upload Image
    			 		Image::make($image_temp)->save($imagePath);

    			 		//save category image
    			 		$category->category_image = $imageName;

    			 	}
    			 }

    		if(empty($data['category_description'])){
    			$data['category_description'] = '';
    		}
    		if(empty($data['category_discount'])){
    			$data['category_discount'] = 0.00;
    		}
    		if(empty($data['meta_title'])){
    			$data['meta_title'] = '';
    		}
    		if(empty($data['meta_description'])){
    			$data['meta_description'] = '';
    		}
    		if(empty($data['meta_keywords'])){
    			$data['meta_keywords'] = '';
    		}

    		$category->parent_id = $data['parent_id'];
    		$category->section_id = $data['section_id'];
    		$category->category_name = $data['category_name'];
    		
    		$category->category_discount = $data['category_discount'];
    		$category->description = $data['category_description'];
    		$category->url = $data['category_url'];
    		$category->meta_title = $data['meta_title'];
    		$category->meta_description = $data['meta_description'];
    		$category->meta_keywords = $data['meta_keywords'];
    		$category->status = 1;
    		
    		$category->save();

    		session::flash('success_message',$message);
    		return redirect('admin/categories');
    	}

    	$getSelection = Section::get();

    	return view('admin.categories.add_edit_category')->with(compact('title','getSelection','categoryData','getCategories'));
    }


    public function appendCategoryLevel(Request $request)
    {
    	if ($request->ajax()) {
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		# code...
    	$getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
    		$getCategories = json_decode(json_encode($getCategories),true);
    		//echo "<pre>"; print_r($getCategory); die;
    		//echo "<pre>"; print_r($getCategories); die;
    		return view('admin.categories.append_categories_level')->with(compact('getCategories'));

    	}
    }

    public function deleteCategoryImage($id)
    {
       //get category image
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        //get categoty image path
        $category_image_path = 'images/category_images';

        //delete category image from category_image flder if exists
        if (file_exists($category_image_path.$categoryImage->category_image)) {
           unlink($category_image_path.$categoryImage->category_image);
        }

        //delete category image from categories table
        Category::where('id',$id)->update(['category_image'=>'']);
        return redirect()->back()->with('success_message','Category image has been deleted successfully!');

    }

    public function deleteCategory($id)
    {
        //delete category
        Category::where('id',$id)->delete();

        return redirect()->back()->with('success_message','Category was deleted successfully!');
    }

}
