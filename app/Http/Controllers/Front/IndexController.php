<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index(){


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
