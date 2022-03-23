<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductsAttribute;
use App\ProductsImage;
use Session;
use App\Section;
use Image;
use App\Brand;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page', 'products');
        /* reducing query to get only required data*/
        $products = Product::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        }])->get();
         /*$products = json_decode(json_encode($products));
        echo "<pre>"; print_r($products); die;*/

        return view('admin.products.products')->with(compact('products'));
    }


   public function updateProductStatus(Request $request){
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
    		Product::where('id', $data['product_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);

    	}
    }

    public function deleteProduct($id)
    {
        //delete category
        Product::where('id',$id)->delete();

        return redirect()->back()->with('success_message','Product was deleted successfully!');
    }

    public function addEditProduct(Request $request, $id=null)
    {
      if($id==""){
        $title = "Add Product";
        $product = new Product;
        $message = "Product Added successfully";
         $productData = array();
      } else {
        $title = "Edit Product";
        $productData = Product::find($id);
        $productData = json_decode(json_encode($productData),true);
        //echo "<pre>"; print_r($productData); die;
        $product = Product::find($id);
        $message = "Product updated successfully";

      }

      if($request->isMethod('post')){
          $data = $request->all();
          //echo "<pre>"; print_r($data); die;
            //product validation
          $rules = [
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'product_code' => 'required|regex:/^[\w-]*$/',
            'product_price' => 'required|numeric',
            'product_color' => 'required|regex:/^[\pL\s\-]+$/u'
        ];

            $customMessages = [
                'category_id.required' => 'Category is require',
                'brand_id.required' => 'Brand is require',
                'product_name.required' => 'Product Name is require',
                'product_name.regex' => 'Valid Product Name is require',
                'product_code.required' => 'Product Code is require',
                'product_code.regex' => 'Valid Product Code is require',
                'product_price.required' => 'Product Price is require',
                'product_price.numeric' => 'Valid Product Price is require',
                'product_color.required' => 'Product Color is require',
                'product_color.regex' => 'Valid Product Color is require',

            ];

         $this->validate($request, $rules, $customMessages);

         //SAve Product Details in Products Table
         $categoryDetails = Category::find($data['category_id']);
        // echo "<pre>"; print_r($categoryDetails); die;
        if(empty($data['is_featured'])){
            $is_feature = 'No';
        } else {
            $is_feature = 'Yes';
        }
        //echo "<pre>"; print_r($is_feature); die;

        //ipload product image
        if($request->hasFile('main_image')){
            $image_tmp = $request->file('main_image');
            if($image_tmp->isValid()){
                //upload images after resize
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                //rename image
                $imageName = $image_name.'-'.rand(100,99999).'.'.$extension;
                $large_image_path = 'images/product_images/large/'.$imageName;
                $medium_image_path = 'images/product_images/medium/'.$imageName;
                $small_image_path = 'images/product_images/small/'.$imageName;
                Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
                Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                //save video into image table
                $product->main_image = $imageName;
            }
        }

        //upload product Video
        if($request->hasFile('product_video')){
            $video_tmp = $request->file('product_video');
            if($video_tmp->isValid()){
                //Upload Vodeo
                $video_name = $video_tmp->getClientOriginalName();
                $videoExtension = $video_tmp->getClientOriginalExtension();
                $videoName = $video_name.'-'.rand().'.'.$videoExtension;
                $video_path = 'videos/product_videos/';
                $video_tmp->move($video_path,$videoName);
                //save video into products table
                $product->product_video = $videoName;
            }
        }


        $product->section_id = $categoryDetails['section_id'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->product_color = $data['product_color'];
        $product->product_code = $data['product_code'];
        $product->product_price = $data['product_price'];
        $product->product_discount = $data['product_discount'];
        $product->product_weight = $data['product_weight'];
        $product->description = $data['product_description'];
        $product->wash_care = $data['wash_care'];
        $product->fabric = $data['fabric'];
        $product->pattern = $data['pattern'];
        $product->sleeve = $data['sleeve'];
        $product->occasion = $data['occasion'];
        $product->fit = $data['fit'];
        $product->meta_title = $data['meta_title'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];
        $product->is_featured = $is_feature;
        $product->status = 1;
        $product->save();
        session::flash('success_message',$message);
        return redirect('admin/products');


      }

      //Filter Arrays
      $fabricArray = array('Cotten','polyster','Wool','none');
      $sleeveArray = array('Full sleave','Half Sleeve','Short Sleeve','none');
      $patternArray = array('ckecked','Plain','Printed','Self','none');
      $fitArray = array('Regular','Slim','none');
      $occasionArray = array('Causual','Formal','none');

      //Sections with Categories and Sub Categories
      $categories = Section::with('categories')->get();
      /*$categories = json_decode(json_encode($categories),true);
      echo "<pre>"; print_r($categories); die;*/

      //get all brands
      $brands = Brand::where('status',1)->get();
      $brands = json_decode(json_encode($brands), true);



      return view('admin.products.add_edit_product')->with(compact('brands','productData','categories','title','sleeveArray','fabricArray','patternArray','occasionArray','fitArray'));

    }

    public function deleteProductImage($id)
    {
        //get product image
        $productImage = Product::select('main_image')->where('id',$id)->first();
        //get product image path
        $large_image_path = 'images/product_images/large/';
        $medium_image_path = 'images/product_images/medium/';
        $small_image_path = 'images/product_images/small/';

        //delete product images from product_images flder if exists
        if (file_exists($large_image_path.$productImage->main_image)) {
           unlink($large_image_path.$productImage->main_image);
        }
        if (file_exists($medium_image_path.$productImage->main_image)) {
            unlink($medium_image_path.$productImage->main_image);
         }
         if (file_exists($small_image_path.$productImage->main_image)) {
            unlink($small_image_path.$productImage->main_image);
         }

        //delete category image from products table
        Product::where('id',$id)->update(['main_image'=>'']);
        return redirect()->back()->with('success_message','Product image has been deleted successfully!');
    }

    public function deleteProductVideo($id)
    {
         //get product image
         $productVideo = Product::select('product_video')->where('id',$id)->first();
         //get product image path
         $product_video_path = 'videos/product_videos/';


         //delete video images from product_images flder if exists
         if (file_exists($product_video_path.$productVideo->product_video)) {
            unlink($product_video_path.$productVideo->product_video);
         }


         //delete category image from categories table
         Product::where('id',$id)->update(['product_video'=>'']);
         return redirect()->back()->with('success_message','Video image has been deleted successfully!');

    }

    //add Attributes
    public function addAttributes(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>"; print_r($data); die;
            foreach ($data['sku'] as $key => $value) {

                if (!empty($value)) {
                      //checing if sku exists
                    $attrCountSKU = ProductsAttribute::where('sku',$value)->count();
                    if($attrCountSKU > 0){
                        return redirect()->back()->with('error_message','SKU already exists please add another SKU');
                    }
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                    if($attrCountSize > 0){
                        return redirect()->back()->with('error_message','Size already exists please add another SKU');
                    }

                    $attribute=new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->$value;
                    $attribute->size = $data['size'][$key];
                    $attribute->sku = $data['sku'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();

                }
            }
            return redirect()->back()->with('success_message','Product attributes has been added successfully');

        }
        $productData = Product::select('id','product_name','product_code','product_color', 'main_image')->with('attributes')->find($id);
        $productData = json_decode(json_encode($productData), true);
       // echo "<pre>"; print_r($productData); die;
        $title = 'Product Attributes';

        return view('admin.products.product_attributes')->with(compact('productData','title'));
    }

    public function editAttributes(Request $request,$id){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                    # code...
                }
            }
            return redirect()->back()->with('success_message','Product attributes has been updated successfully');

        }

    }

    public function updateAttributeStatus(Request $request){
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
    		ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);

    	}
    }

    public function deleteAttribute($id)
    {
        //delete attribute
        ProductsAttribute::where('id',$id)->delete();

        return redirect()->back()->with('success_message','Product Attribute was deleted successfully!');
    }
    public function addImages(Request $request,$id)
    {
        if($request->isMethod('post')){
            if($request->hasFile('images')){
                $images = $request->file('images');
               // echo "<pre>"; print_r($images); die;
               foreach ($images as $key => $image) {
                   $productImage = new ProductsImage;
                   $image_tmp = Image::make($image);
                   $extension = $image->getClientOriginalExtension();
                   $imageName = rand(111,9999).time().".".$extension;

                   //set path to image sizes
                   $large_image_path = 'images/product_images/large/'.$imageName;
                   $medium_image_path = 'images/product_images/medium/'.$imageName;
                   $small_image_path = 'images/product_images/small/'.$imageName;
                   //upload images according to their sizes
                   Image::make($image_tmp)->save($large_image_path); // W:1040 H:1200
                   Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    //save image path
                   $productImage->images = $imageName;
                   $productImage->product_id = $id;
                   $productImage->status = 1;
                   $productImage->save();

               }

              return redirect()->back()->with('success_message','Product Image has been added successfully!');

            }


        }
        $title = 'Add Images';
       $productData = Product::with('images')->select('id','product_name','product_code','product_color', 'main_image')->where('id',$id)->first();
       //$productData = json_decode(json_encode($productData));
       //echo "<pre>"; print_r($productData); die;

       return view('admin.products.add_images')->with(compact('productData','title'));

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
    		ProductsImage::where('id', $data['image_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);

    	}
    }

    public function deleteImage($id)
    {
        //get product image
        $productImage = ProductsImage::select('images')->where('id',$id)->first();
        //get product image path
        $large_image_path = 'images/product_images/large/';
        $medium_image_path = 'images/product_images/medium/';
        $small_image_path = 'images/product_images/small/';

        //delete product images from product_images flder if exists
        if (file_exists($large_image_path.$productImage->images)) {
           unlink($large_image_path.$productImage->images);
        }
        if (file_exists($medium_image_path.$productImage->images)) {
            unlink($medium_image_path.$productImage->images);
         }
         if (file_exists($small_image_path.$productImage->images)) {
            unlink($small_image_path.$productImage->images);
         }
        //delete category image from products_Images table
        ProductsImage::where('id',$id)->delete();

       return redirect()->back()->with('success_message','Product image was deleted successfully!');
    }

}
