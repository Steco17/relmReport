<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use App\Sms;
use Image;
use App\Country;

class UsersController extends Controller
{
    public function loginRegister(Request $request)
    {
        return view('front.users.login_register');
    }

         //register user
    public function loginUser(Request $request)
    {
       if($request->isMethod('post')){
           $data = $request->all();
           //echo "<pre>"; print_r($data); die;
           if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){

            //check if user email is active or not
            $userStatus = User::where('email',$data['email'])->first();
            if($userStatus->status == 0){
                Auth::logout();
                $message = 'Your account is not activated yet! Please confirm your email to activate!';
                session::flash('error_message', $message);
                return redirect()->back()->with(['message' => $message, 'alert' => 'alert-danger']);
            }

            return redirect('/');

           } else {
            $message = 'Invalid username or password';
            session::flash('error_message', $message);
            return redirect()->back()->with(['message' => $message, 'alert' => 'alert-danger']);
           }

       }
    }

    //register user
    public function registerUser(Request $request)
    {
       if($request->isMethod('post')){
           $data = $request->all();
           //echo "<pre>"; print_r($data); die;
           //check if user already exists
           $userCount = User::where('email',$data['email'])->count();
           if($userCount > 0){
               $message = 'Email aleady exists!';
               session::flash('error_message', $message);
               return redirect()->back();
           } else {

               $user = new User;
               $user->name = $data['name'];
               $user->mobile = $data['mobile'];
               $user->email = $data['email'];
               $user->password =  bcrypt($data['password']);
               $user->status = 0;
               $user->save();

                /*if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){

                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }

                    //send sms
                   $message = "Dear Customer, you have successfully registered  on BeautyAccessorize Login to access your account orders and availbale offers";
                    $mobile = $data['mobile'];
                  //  Sms::sendSms($message, $mobile);

                  //send Registered Email
                  /*$email = $data['email'];
                  $messageData = ['name'=>$data['name'], 'mobile'=>$data['mobile'], 'email'=>$data['email']];

                  Mail::send('emails.register', $messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome to MFOKU website');
                  });

                  return redirect('cart');

               }*/

               // send confirmation email to user
                $email = $data['email'];
                $messageData = [
                    'name'=>$data['name'],
                    'mobile'=>$data['mobile'],
                    'email'=>$data['email'],
                    'code'=>base64_encode($data['email']),
                ];

                Mail::send('emails.confirmation', $messageData, function($message) use($email){
                    $message->to($email)->subject('MFOKU Account Confirmation ');
                });

                $message = 'Please a check your email to activate your account';
                session::flash('success_message', $message);
                return redirect()->back();


           }
       }
    }

    //logout
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

    public function checkEmail(Request $request)
    {
        //check if email exists already
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if($emailCount >0){
            return "false";
        } else{
            return "true";
        }
    }
    public function confirmAccount($code)
    {
        $email = base64_decode($code);

        $userCount = User::where('email',$email)->count();
        if($userCount>0){
            //activating user account
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                $message = 'Your Email account is active. Please Login.';
                session::flash('success_message', $message);
                return redirect('login-register');
            } else{
                //uopdate user status to active 1
                User::where('email',$email)->update(['status'=>1]);
                //send Registered Email
                  $email = $userDetails['email'];
                  $messageData = ['name'=>$userDetails['name'], 'mobile'=>$userDetails['mobile'], 'email'=>$userDetails['email']];

                  Mail::send('emails.register', $messageData, function($message) use($email){
                    $message->to($email)->subject('Welcome to MFOKU website');
                  });

                  //Redirect to login/registration page with success message
                  $message = 'Your  account is active now. You can Login.';
                  session::flash('success_message', $message);
                  return redirect('login-register');
            }
        }else{
            abort(404);
        }

    }

    public function forgotPassword(Request $request)
    {

        session::forget('error_message');
        session::forget('success_message');
        if ($request->isMethod('post')) {
            $data = $request->all();
           //echo "<pre>"; print_r($data); die;
           $emailCount = User::where('email',$data['email'])->count();
           if($emailCount == 0){
            $message = 'Sorry, this email address does not exist';
            session::put('error_message', $message);
            session::forget('success_message');
            return redirect()->back();
           } else{

            //generating new password
            $random_password = str_random(8);

            //Encode/secure password
            $new_password = bcrypt($random_password);

            //update password
            User::where('email',  $data['email'])->update(['password'=>$new_password]);

            // Get user Name
            $userName = User::select('name')->where('email',$data['email'])->first();

            //send forgotten Password Email

            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name'=>$name,
                'password'=>$random_password,
            ];

            Mail::send('emails.forgot_password', $messageData, function($message) use($email){
                $message->to($email)->subject('New Password - MFOKU');
              });

              //redirect to login/register page with ssuccess message
              $message = 'Please check your email for the new password';
              session::put('success_message', $message);
              session::forget('error_message');
              return redirect('login-register');


           }
        }

       return view('front.users.forgot_password');
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        $countries = Country::where('status',1)->get()->toArray();
        //echo "<pre>"; print_r($countries); die;
        if ($request->isMethod('post')) {
            $data = $request->all();
            session::forget('error_message');
            session::forget('success_message');

            $rules = [
                'user_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'user_mobile' => 'required|numeric',
                'user_image' => 'image'
            ];

                $customMessages = [
                    'user_name.required' => 'Name is require',
                    'user_name.regex' => 'A valid name is require',
                    'user_mobile.required' => 'Mobile Number is require',
                    'user_mobile.numeric' => 'Mobile Number is not valid',
                    'user_image.image' => 'Valid image is require'

                ];

             $this->validate($request, $rules, $customMessages);
            // echo "<pre>"; print_r($data); die;


            //upload image
    			 if ($request->hasFile('user_image')) {
                    # code...
                    $image_temp = $request->file('user_image');
                    if ($image_temp->isValid()) {
                        # code... het image extension
                        $extension = $image_temp->getClientOriginalExtension();
                        //generate Image Name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'images/front_images/user_photos/'.$imageName;
                        //upload Image
                        Image::make($image_temp)->resize(400,400)->save($imagePath);

                    } else if (!empty($data['current_user_image'])) {
                        $imageName = $data['current_user_image'];
                    } else{
                        $imageName = "";
                    }
                }


            if (empty($imageName)) {
                $imageName = "";
            } elseif($imageName == '' ){
                $imageName = "";
            }


            $user = User::find($user_id);
            $user->name = $data['user_name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->State = $data['State'];
            $user->country = $data['country'];
            $user->mobile = $data['user_mobile'];
           // $user->pincode = $data['pincode'];
            $user->image = $imageName;
            $user->save();
            //return redirect()->back();
            $message = 'Your account details has been updated!';
              session::flash('success_message', $message);
              return redirect()->back();
        }

        return view('front.users.account')->with(compact('userDetails','countries'));
    }
    public function chkUserPassword(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $user_id = Auth::User()->id;

            $chkPassword = User::select('password')->where('id',$user_id)->first();
            //echo "<pre>"; print_r($chkPassword); die;
            if(Hash::check($data['current_pwd'], $chkPassword->password)){
                return "true";
            } else{
                return "false";
            }

        }
    }
    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $user_id = Auth::User()->id;

            $chkPassword = User::select('password')->where('id',$user_id)->first();
            //echo "<pre>"; print_r($chkPassword); die;
            if(Hash::check($data['current_pass'], $chkPassword->password)){
              //update current password
              $new_pwd = bcrypt($data['new_password']);
              User::where('id',$user_id)->update(['password'=>$new_pwd]);
              $message = 'Password Updated';
              session::flash('success_message', $message);
              return redirect()->back();
            } else{
                $message = 'Retry again or contact admin';
                session::flash('error_message', $message);
                return redirect()->back();

            }

        }
    }

    public function updateAccountDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        $countries = Country::where('status',1)->get()->toArray();
        //echo "<pre>"; print_r($countries); die;
        if ($request->isMethod('post')) {
            $data = $request->all();
            session::forget('error_message');
            session::forget('success_message');

            $rules = [
                'user_name' => 'required|regex:/(^[A-Za-z ]+$)+/',
                'user_mobile' => 'required|numeric',
                'user_image' => 'image'
            ];

                $customMessages = [
                    'user_name.required' => 'Name is require',
                    'user_name.regex' => 'A valid name is require',
                    'user_mobile.required' => 'Mobile Number is require',
                    'user_mobile.numeric' => 'Mobile Number is not valid',
                    'user_image.image' => 'Valid image is require'

                ];

             $this->validate($request, $rules, $customMessages);
            // echo "<pre>"; print_r($data); die;


            //upload image
    			 if ($request->hasFile('user_image')) {
                    # code...
                    $image_temp = $request->file('user_image');
                    if ($image_temp->isValid()) {
                        # code... het image extension
                        $extension = $image_temp->getClientOriginalExtension();
                        //generate Image Name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'images/front_images/user_photos/'.$imageName;
                        //upload Image
                        Image::make($image_temp)->resize(400,400)->save($imagePath);

                    } else if (!empty($data['current_user_image'])) {
                        $imageName = $data['current_user_image'];
                    } else{
                        $imageName = "";
                    }
                }


            if (empty($imageName)) {
                $imageName = "";
            } elseif($imageName == '' ){
                $imageName = "";
            }


            $user = User::find($user_id);
            $user->name = $data['user_name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->mobile = $data['user_mobile'];
           // $user->pincode = $data['pincode'];
            $user->image = $imageName;
            $user->save();
            //return redirect()->back();
            $message = 'Your account details has been updated!';
              session::flash('success_message', $message);
              return redirect()->back();
        }

        return view('front.users.accountUpdate')->with(compact('userDetails','countries'));
    }

    public function updateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        $countries = Country::where('status',1)->get()->toArray();

        if ($request->ajax()){
            $data = $request->all();
            session::forget('error_message');
            session::forget('success_message');


            //
            echo "<pre>"; print_r($data); die;

            //upload image
    			 if ($request->hasFile('user_image')) {
                    # code...
                    $image_temp = $request->file('user_image');
                    if ($image_temp->isValid()) {
                        # code... het image extension
                        $extension = $image_temp->getClientOriginalExtension();
                        //generate Image Name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'images/front_images/user_photos/'.$imageName;
                        //upload Image
                        Image::make($image_temp)->resize(400,400)->save($imagePath);

                    } else if (!empty($data['current_user_image'])) {
                        $imageName = $data['current_user_image'];
                    } else{
                        $imageName = "";
                    }
                }


            if (empty($imageName)) {
                $imageName = "";
            } elseif($imageName == '' ){
                $imageName = "";
            }



            $user = User::find($user_id);
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->mobile = $data['user_mobile'];
           // $user->pincode = $data['pincode'];
            $user->image = $imageName;
            $user->save();
            //return redirect()->back();
            $message = 'Your account details has been updated!';

              return response()->json(
                [
                  'success' => true,
                  'message' => $message
                ]
              );
        }

    }

}
