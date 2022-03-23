<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        /* reducing query to get only required data*/
        $brands = Brand::get();
         /*$products = json_decode(json_encode($products));
        echo "<pre>"; print_r($products); die;*/

        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request){
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
    		Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);

    	}
    }

    public function addEditBrand(Request $request, $id=null)
    {
        Session::put('page', 'brands');
        if($id==""){
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand Added successfully";
             $BrandData = array();
          } else {
            $title = "Edit Brand";
            $BrandData = Brand::find($id);
            $BrandData = json_decode(json_encode($BrandData),true);
            //echo "<pre>"; print_r($productData); die;
            $brand = Brand::find($id);
            $message = "Brand updated successfully";

          }

          if ($request->isMethod('post')) {
              $data = $request->all();
             // echo "<pre>"; print_r($data); die;

              //brand validation
              $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

                $customMessages = [
                    'brand_name.required' => 'Brand is require',
                    'brand_name.regex' => 'A valid Brand Name is require',
                ];

             $this->validate($request, $rules, $customMessages);

             //echo "<pre>"; print_r($data); die;

             $brand->name = $data['brand_name'];
             $brand->save();

             $request->session()->flash('success_message', $message);

             return redirect('admin/brands');
          }

          return view('admin.brands.add_edit_brand')->with(compact('BrandData','title','brand'));
    }

    public function deleteBrand($id=null)
    {
            //delete attribute
            Brand::where('id',$id)->delete();

            return redirect()->back()->with('success_message','Brand was deleted successfully!');

    }

}
