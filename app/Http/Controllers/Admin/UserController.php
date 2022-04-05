<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use Image;

class UserController extends Controller
{
    public function users()
    {
        Session::put('page', 'users');
        /* reducing query to get only required data*/
        $users = User::get();

        return view('admin.users.users')->with(compact('users'));
    }

    public function updateUserstatus(Request $request){
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
    		User::where('id', $data['user_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status, 'user_id'=>$data['user_id']]);

    	}
    }

    public function deleteUser($id)
    {
        //delete category
        $userImage = User::select('image')->where('id',$id)->first();

        $large_image_path = 'images/user_images/large/';
        $medium_image_path = 'images/user_images/medium/';
        $small_image_path = 'images/user_images/small/';

        //delete Package images from user_images flder if exists
        if (file_exists($large_image_path.$userImage->images)) {
           unlink($large_image_path.$userImage->images);
        }
        if (file_exists($medium_image_path.$userImage->images)) {
            unlink($medium_image_path.$userImage->images);
         }
         if (file_exists($small_image_path.$userImage->images)) {
            unlink($small_image_path.$userImage->images);
         }
        //delete category image from Packages_Images table
        User::where('id',$id)->delete();


        return redirect()->back()->with('success_message','User was deleted successfully!');
    }

    public function addEditUser(Request $request, $id=null)
    {
      if($id==""){
        $title = "Add User";
        $User = new User;
        $message = "Package Added successfully";
        $userData = array();
      } else {
        $title = "Edit Package";
        $userData = User::find($id);
        $userData = json_decode(json_encode($userData),true);
        //echo "<pre>"; print_r($PackageData); die;
        $User = User::find($id);
        $message = "User updated successfully";

      }

      if($request->isMethod('post')){
          $data = $request->all();
          //echo "<pre>"; print_r($data); die;

            //Package validation
          $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|'
        ];

            $customMessages = [
                'name.required' => 'Name is require',
                'name.regex' => 'Name is require',
                'email.required' => 'email is require'
            ];

         $this->validate($request, $rules, $customMessages);


        // echo "<pre>"; print_r($categoryDetails); die;
        if(empty($data['status'])){
            $is_feature = 'No';
        } else {
            $is_feature = 'Yes';
        }
        //echo "<pre>"; print_r($is_feature); die;

        //ipload Package image
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                //upload images after resize
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                //rename image
                $imageName = $image_name.'-'.rand(100,99999).'.'.$extension;
                $large_image_path = 'images/user_images/large/'.$imageName;
                $medium_image_path = 'images/user_images/medium/'.$imageName;
                $small_image_path = 'images/user_images/small/'.$imageName;
                Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
                Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                //save video into image table
                $User->image = $imageName;
            }
        }

        $User->name = $data['name'];
        $User->email = $data['email'];
        $User->mobile = $data['mobile'];
        $User->password = bcrypt($data['password']);
        $User->address = $data['address'];
        $User->city = $data['city'];
        $User->state = $data['state'];
        $User->country = "USA";
        $User->status = 1;
        $User->save();
        session::flash('success_message',$message);
        return redirect('admin/users');


      }

      return view('admin.users.add_edit_user')->with(compact('userData','title'));

    }

}
