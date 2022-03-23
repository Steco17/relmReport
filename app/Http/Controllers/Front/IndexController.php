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

    public function shop(){
        Paginator::useBootstrap();
        $page_name = "listing";

        $allProducts = Product::where('status',1);

        //check if sort is selected by user
        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            if ($_GET['sort'] == "product_latest") {
                $allProducts->orderBy('id','desc');
            }
            if ($_GET['sort'] == "price_lowest") {
                $allProducts->orderBy('product_price','asc');
            }
            if ($_GET['sort'] == "price_highest") {
                $allProducts->orderBy('product_price','desc');
            }
        } else{

        }

        $allProducts =   $allProducts->paginate(3);

        $recentlyViewspdts = Product::where('status',1)->orderBy('created_at', 'asc')->inRandomOrder()->limit(3)->get()->toArray();
        $topProducts = Product::where('status',1)->inRandomOrder()->limit(3)->get()->toArray();

        return view('front.shop')->with(compact('page_name','topProducts','recentlyViewspdts','allProducts'));
    }

    public function categories(){
        $page_name = "categories";

        $categories = Category::with(['section','parentCategory'])->get();

        return view('front.categories.categories')->with(compact('page_name','categories'));
    }

    public function contact(Request $request)
    {
        return view('front.users.contact');
    }
}
