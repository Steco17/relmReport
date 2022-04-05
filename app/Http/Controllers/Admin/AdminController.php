<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;
use App\Admin;
use Image;

class AdminController extends Controller
{

	public function login(Request $request){
		if ($request->isMethod('post')) {
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;

			$rules =[
		        'email' => 'required|email|max:255',
		        'password' => 'required',
		    ];
		    $customMessages = [
		    	'email.required' => 'Email is requires',
		    	'email.email' => 'valid Email is required',
		    	'password.required' => 'Password is required'
		    ];

		    $this->validate($request, $rules, $customMessages);

			if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
				return redirect('admin/dashboard');

			} else{
				Session::flash('error_message','Invalid Email or Password');
				return redirect('/admin');
			}
		}
		return view('admin.admin_login');
	}

	public function logout(){
		Auth::guard('admin')->logout();
		return redirect('/admin');

	}
    //
    public function dashboard(){
    	Session::put('page', 'dashboard');
    	return view('admin.admin_dashboard');
    }

    public function settings(){
    	Session::put('page', 'settings');
    	$adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
    	//echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
    	return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function chkCurrentPassword(Request $request){
    	$data = $request->all();
    	//echo "<pre>"; print_r($data); die;
    	if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
    		# code...
    		echo "true";
    	} else{
    		echo "false";
    	}

    }

    public function updateCurrentPassword(Request $request){

    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		# code...
    		//checking currnt pwd is coorect
    		if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
    			//check if new current pwd is matching
    			if ($data['new_pwd'] == $data['confirn_pwd']) {
    				# code...
    				Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
    				Session::flash('success_message','Your new password has been updatedcarefully');
    			} else {
    				Session::flash('error_message','Your new password and conform password does not match');
    				return redirect()->back();
    			}
    		} else{
    			Session::flash('error_message','Your current password is not correct');

    		}
    		return redirect()->back();
    	}
    }

    public function updateAdminDetails (Request $request){
    	Session::put('page', 'update-admin-details');
    		if ($request->isMethod('post')) {
    			$data = $request->all();
    			$imageName = "";
    			//echo "<pre>"; print_r($data); die;

    			$rules = [
    				'admin_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
    				'admin_mobile' => 'required|numeric',
    				'admin_image' => 'image'
    			];

    				$customMessages = [
    					'admin_name.required' => 'Name is require',
    					'admin_name.regex' => 'valid Name is require',
    					'admin_mobile.required' => 'Mobile is require',
    					'admin_image.image' => 'Valid image is require'

    				];

    			 $this->validate($request, $rules, $customMessages);

    			 //upload image
    			 if ($request->hasFile('admin_image')) {
    			 	# code...
    			 	$image_temp = $request->file('admin_image');
    			 	if ($image_temp->isValid()) {
    			 		# code... het image extension
    			 		$extension = $image_temp->getClientOriginalExtension();
    			 		//generate Image Name
    			 		$imageName = rand(111,99999).'.'.$extension;
    			 		$imagePath = 'images/admin_images/admin_photos/'.$imageName;
    			 		//upload Image
    			 		Image::make($image_temp)->resize(400,400)->save($imagePath);

    			 	} else if (!empty($data['current_admin_image'])) {
    			 		$imageName = $data['current_admin_image'];
    			 	} else{
    			 		$imageName = "";
    			 	}
    			 }

    			 Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
    			 session::flash('success_message', 'Admin details updatd successfully!');
    			 return redirect()->back();

    		}
    	return view('admin.update_admin_details');
    }

}
