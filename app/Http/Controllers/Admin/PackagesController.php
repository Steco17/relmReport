<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Category;
use App\PackagesImage;
use Session;
use App\Section;
use Image;

class PackagesController extends Controller
{
        public function packages(){
        Session::put('page', 'package');
        /* reducing query to get only required data*/
        $Packages = Package::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        }])->get();
         /*$Packages = json_decode(json_encode($Packages));
        echo "<pre>"; print_r($Packages); die;*/

        return view('admin.packages.packages')->with(compact('Packages'));
    }


   public function updatePackagestatus(Request $request){
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
    		Package::where('id', $data['package_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status, 'package_id'=>$data['package_id']]);

    	}
    }

    public function deletePackage($id)
    {
        //delete category
        Package::where('id',$id)->delete();

        return redirect()->back()->with('success_message','Package was deleted successfully!');
    }

    public function addEditPackage(Request $request, $id=null)
    {
      if($id==""){
        $title = "Add Package";
        $package = new Package;
        $message = "Package Added successfully";
        $packageData = array();
      } else {
        $title = "Edit Package";
        $packageData = Package::find($id);
        $packageData = json_decode(json_encode($packageData),true);
        //echo "<pre>"; print_r($PackageData); die;
        $package = Package::find($id);
        $message = "Package updated successfully";

      }

      if($request->isMethod('post')){
          $data = $request->all();
          //echo "<pre>"; print_r($data); die;


          // Available alpha caracters
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// generate a pin based on 2 * 7 digits + a random character
		$pin = mt_rand(1000000, 9999999)
		    . mt_rand(1000000, 9999999)
		    . $characters[rand(0, strlen($characters) - 1)];

		// shuffle the result
		$string = str_shuffle($pin);
		$data['package_code'] = Package::generateRandomString(6);

            //Package validation
          $rules = [
            'category_id' => 'required',
            'brand_id' => 'required',
            'Package_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'Package_code' => 'required|regex:/^[\w-]*$/',
            'Package_price' => 'required|numeric',
            'Package_color' => 'required|regex:/^[\pL\s\-]+$/u'
        ];

            $customMessages = [
                'category_id.required' => 'Category is require',
                'brand_id.required' => 'Brand is require',
                'Package_name.required' => 'Package Name is require',
                'Package_name.regex' => 'Valid Package Name is require',
                'Package_code.required' => 'Package Code is require',
                'Package_code.regex' => 'Valid Package Code is require',
                'Package_price.required' => 'Package Price is require',
                'Package_price.numeric' => 'Valid Package Price is require',
                'Package_color.required' => 'Package Color is require',
                'Package_color.regex' => 'Valid Package Color is require',

            ];

         $this->validate($request, $rules, $customMessages);

         //SAve Package Details in Packages Table
         $categoryDetails = Category::find($data['category_id']);
        // echo "<pre>"; print_r($categoryDetails); die;
        if(empty($data['is_featured'])){
            $is_feature = 'No';
        } else {
            $is_feature = 'Yes';
        }
        //echo "<pre>"; print_r($is_feature); die;

        //ipload Package image
        if($request->hasFile('main_image')){
            $image_tmp = $request->file('main_image');
            if($image_tmp->isValid()){
                //upload images after resize
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                //rename image
                $imageName = $image_name.'-'.rand(100,99999).'.'.$extension;
                $large_image_path = 'images/Package_images/large/'.$imageName;
                $medium_image_path = 'images/Package_images/medium/'.$imageName;
                $small_image_path = 'images/Package_images/small/'.$imageName;
                Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
                Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                //save video into image table
                $Package->main_image = $imageName;
            }
        }

        //upload Package Video
        if($request->hasFile('Package_video')){
            $video_tmp = $request->file('package_video');
            if($video_tmp->isValid()){
                //Upload Vodeo
                $video_name = $video_tmp->getClientOriginalName();
                $videoExtension = $video_tmp->getClientOriginalExtension();
                $videoName = $video_name.'-'.rand().'.'.$videoExtension;
                $video_path = 'videos/package_videos/';
                $video_tmp->move($video_path,$videoName);
                //save video into Packages table
                $Package->package_video = $videoName;
            }
        }

        
        $Package->section_id = $categoryDetails['section_id'];
        $Package->category_id = $data['category_id'];
        $Package->package_name = $data['package_name'];
        $Package->package_color = $data['package_color'];
        $Package->package_code = $data['package_code'];
        $Package->package_price = $data['package_price'];
        $Package->package_discount = $data['package_discount'];
        $Package->package_weight = $data['package_weight'];
        $Package->description = $data['package_description'];
        $Package->destination_country = $data['destination_country'];
        $Package->destination_region = $data['destination_state'];
        $Package->destination_city = $data['destination_city'];
        $Package->package_length = $data['package_length'];
        $Package->package_height = $data['package_height'];
        $Package->package_width = $data['package_width'];
        $Package->content = $data['package_content'];
        $Package->meta_title = $data['meta_title'];
        $Package->meta_description = $data['meta_description'];
        $Package->meta_keywords = $data['meta_keywords'];
        $Package->is_featured = $is_feature;
        $Package->status = 1;
        $Package->save();
        session::flash('success_message',$message);
        return redirect('admin/packages');


      }

      //Filter Arrays
      $CountryArray = array('Cameroon');
      $StateArray = array('Littoral','Center','West','East','North');

      //Sections with Categories and Sub Categories
      $categories = Section::with('categories')->get();
      /*$categories = json_decode(json_encode($categories),true);
      echo "<pre>"; print_r($categories); die;*/

      return view('admin.packages.add_edit_package')->with(compact('packageData','categories','title','CountryArray','StateArray'));

    }

    public function deletePackageImage($id)
    {
        //get Package image
        $PackageImage = Package::select('main_image')->where('id',$id)->first();
        //get Package image path
        $large_image_path = 'images/package_images/large/';
        $medium_image_path = 'images/package_images/medium/';
        $small_image_path = 'images/package_images/small/';

        //delete Package images from Package_images flder if exists
        if (file_exists($large_image_path.$PackageImage->main_image)) {
           unlink($large_image_path.$PackageImage->main_image);
        }
        if (file_exists($medium_image_path.$PackageImage->main_image)) {
            unlink($medium_image_path.$PackageImage->main_image);
         }
         if (file_exists($small_image_path.$PackageImage->main_image)) {
            unlink($small_image_path.$PackageImage->main_image);
         }

        //delete category image from Packages table
        Package::where('id',$id)->update(['main_image'=>'']);
        return redirect()->back()->with('success_message','package image has been deleted successfully!');
    }

    public function deletePackageVideo($id)
    {
         //get Package image
         $PackageVideo = Package::select('Package_video')->where('id',$id)->first();
         //get Package image path
         $Package_video_path = 'videos/package_videos/';


         //delete video images from Package_images flder if exists
         if (file_exists($Package_video_path.$PackageVideo->Package_video)) {
            unlink($Package_video_path.$PackageVideo->Package_video);
         }


         //delete category image from categories table
         Package::where('id',$id)->update(['package_video'=>'']);
         return redirect()->back()->with('success_message','Video has been deleted successfully!');

    }


    public function addImages(Request $request,$id)
    {
        if($request->isMethod('post')){
            if($request->hasFile('images')){
                $images = $request->file('images');
               // echo "<pre>"; print_r($images); die;
               foreach ($images as $key => $image) {
                   $packageImage = new PackagesImage;
                   $image_tmp = Image::make($image);
                   $extension = $image->getClientOriginalExtension();
                   $imageName = rand(111,9999).time().".".$extension;

                   //set path to image sizes
                   $large_image_path = 'images/package_images/large/'.$imageName;
                   $medium_image_path = 'images/package_images/medium/'.$imageName;
                   $small_image_path = 'images/package_images/small/'.$imageName;
                   //upload images according to their sizes
                   Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
                   Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    //save image path
                   $packageImage->images = $imageName;
                   $packageImage->Package_id = $id;
                   $packageImage->status = 1;
                   $packageImage->save();

               }

              return redirect()->back()->with('success_message','Package Image has been added successfully!');

            }


        }
        $title = 'Add Images';
       $packageData = Package::with('images')->select('id','package_name','destination_region','destination_city', 'main_image')->where('id',$id)->first();
       //$PackageData = json_decode(json_encode($PackageData));
       //echo "<pre>"; print_r($PackageData); die;

       return view('admin.packages.add_images')->with(compact('packageData','title'));

    }

    public function updateImageStatus(Request $request)
    {
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
    		PackagesImage::where('id', $data['image_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);

    	}
    }

    public function deleteImage($id)
    {
        //get Package image
        $packageImage = PackagesImage::select('images')->where('id',$id)->first();
        //get Package image path
        $large_image_path = 'images/package_images/large/';
        $medium_image_path = 'images/package_images/medium/';
        $small_image_path = 'images/package_images/small/';

        //delete Package images from Package_images flder if exists
        if (file_exists($large_image_path.$packageImage->images)) {
           unlink($large_image_path.$packageImage->images);
        }
        if (file_exists($medium_image_path.$packageImage->images)) {
            unlink($medium_image_path.$packageImage->images);
         }
         if (file_exists($small_image_path.$packageImage->images)) {
            unlink($small_image_path.$packageImage->images);
         }
        //delete category image from Packages_Images table
        PackagesImage::where('id',$id)->delete();

       return redirect()->back()->with('success_message','Package image was deleted successfully!');
    }

}
