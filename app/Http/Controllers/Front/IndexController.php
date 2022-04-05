<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Category;
use Illuminate\Pagination\Paginator;
use App\Package;

class IndexController extends Controller
{
    public function index(){
        $page_name = "index";
        $featureItemsCount = Package::where('is_featured','Yes')->where('status',1)->count();

        $featuredItems = Package::where('is_featured','Yes')->where('status',1)->with(['category'=>function($query){
            $query->select('id','category_name','url');
        },'section'=>function($query){
            $query->select('id','name');
        }])->where('is_featured','Yes')->inRandomOrder()->limit(24)->get()->toArray();

        $categories = Category::where('status',1)->inRandomOrder()->limit(4)->get();

        $newProducts = Package::where('is_featured','Yes')->where('status',1)->orderBy('id','Desc')->limit(6)->get()->toArray();

        //dd($featuredItems); die;
       // $featuredItemsChunk = array_chunk($featuredItems, 4);
       // echo "<pre>"; print_r($categories); die;

       // return view('front.index')->with(compact('page_name','featuredItems','categories','newProducts'));
        return view('front.home.welcome');
    }


    public function contact(Request $request)
    {
        return view('front.users.contact');
    }
}
