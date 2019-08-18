<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function fetchElements(Request $request){
        $elements = Element::all();

        return view('element')->with('el', $elements);

    }
}
