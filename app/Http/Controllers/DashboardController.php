<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function isAdmin()
    {
        if (auth()->check()) {
            if (Auth::id() == 4) {
                return true;
            }
        }
        return false;
    }

    function index()
    {
        if ($this->isAdmin()) {
            return view('layouts.dashboard.index');
        } else
            return redirect('/posts');


    }

    function charts()
    {
        if ($this->isAdmin())
            return view('layouts.dashboard.charts');
        else
            return redirect('/posts');
    }

    function products()
    {

        $products = Post::all();
        if ($this->isAdmin())
            return view('layouts.dashboard.products')->with('products',$products);
        else
            return redirect('/posts');
    }

    function orders()
    {

        $products = Orders::all();
        if ($this->isAdmin())
            return view('layouts.dashboard.orders')->with('products',$products);
        else
            return redirect('/dashboard');
    }


}
