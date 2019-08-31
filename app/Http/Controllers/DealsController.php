<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use mysql_xdevapi\Session;

class DealsController extends Controller
{
    public function deals(Request $request){
        $deals = Deal::all();
        $posts = Array();
        foreach ($deals as $deal){
            $post = Post::find($deal->item);
            if($post!==null) {
                $post->rating = $post->price;
                $post->price = $deal->discount;
                array_push($posts, $post);
            }
        }

        return view('deals')->with('posts',$posts);
    }


    public function index(Request $request){
        $deals = Deal::all();

        return view('layouts.dashboard.deals')->with('products',$deals);
    }

    public function newDeal(Request $request){
        return view('new-deal');
    }


    public function store(Request $request){
        $deal = new Deal;

        $deal->item = $request->input('id');
        $deal->title = $request->input('title');

//        try {
//            $item = Post::where('title', $deal->title);
//
//            $deal->item = $item;
//        }catch (\Exception $e){
//
//        }
        $deal->quantity = $request->input('quantity');
        $deal->discount = $request->input('discount-price');


        $deal->save();

        \session()->flash('success',' deal successfully added');

        return redirect('/dashboard/deals');

    }


}
