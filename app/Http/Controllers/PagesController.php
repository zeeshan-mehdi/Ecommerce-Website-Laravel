<?php

namespace App\Http\Controllers;

use App\Orders;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Post;
use App\cart;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;


class PagesController extends Controller
{
    public function homePage(){
        return redirect('/posts');
    }

    public function newPostPage(){

        return view('new');
    }
    public function aboutPage(){
        return view('about');
    }


    public function checkoutPage(){
        $value = session('total');

        if($value==0){
            redirect('/cart');
        }

        return view('checkout')->with('value',$value);
    }

    public function cartCheckout(){
        $cart = null;
        session()->has('cart')? $cart = \session('cart') : null;


        if($cart===null){
            return view('cart')->with('cart',null);
        }

        \session(['total'=>$cart->totalPrice]);
        \session(['qty'=>$cart->totalQuantity]);

        return view('cart')->with('cart',$cart->item);
    }


    public function searchPage(Request $request){

        $searchString = $request->input('search-input');


        $posts = Post::where('title','like',"%$searchString%")->get();

        return view('search')->with('posts',$posts);
    }

    public function footer(){
        return view('layouts.footer');
    }

    public function showProfile(Request $request,$id){
        return view('profile');
    }
    public function ordersPage(){
        if(Auth::check()){
            $id = Auth::id();

            $orders = new Orders();
            $orders = Orders::where('user_id',$id)->get();

            $items = Array();

            foreach ($orders as $order){
                $post = Post::find($order->item);

                if($post!==null) {

                    $val = new Post;

                    $val->title = $post->title;
                    $val->description = $post->description;
                    $val->quantity = $order->quantity;
                    $val->price = $order->price;
                    $val->status = $order->status;
                    array_push($items, $val);
                }
            }

            return view('orders')->with('cart',$items);

        }else{
           return redirect('/login');
        }

    }

    public function categoryPage(Request $request,$category){

        $posts = Post::where('category',$category)->paginate(12);

        return view('index')->with('posts',$posts);
    }

}

