<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::paginate(12);

        return view('index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'category'=>'required',
            'price'=>'required'
//            'image'=>'image|nullable|max:1999'
        ]);

        $nameToStore =null;
        $path = null;

        if($request->hasFile('image')){
            $nameWithExtension = $request->file('image')->getClientOriginalName();

            //name

            $fileName = pathinfo($nameWithExtension,PATHINFO_FILENAME);

            //extension

            $extension = $request->file('image')->getClientOriginalExtension();


            $nameToStore = $fileName.'_'.time().'.'.$extension;

            $path= $request->file('image')->storeAs('public/images',$nameToStore);

        }else{
            $nameToStore='noImage.jpg';
        }



        $post = new Post;

        $post->title = $request->input('title');
        $post->description = $request->input('desc');
        $post->price = $request->input('price');
        $post->quantity = $request->input('quantity');
        $post->vendor = $request->input('vender');
        $post->category = $request->input('category');

        $post->total = $request->input('quantity');
        $post->reviews = "No Review Yet";
        $post->rating = "No Rating Yet";

        $post->image=$request->input('image-url');;
        $post->save();

        return redirect('/dashboard/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Post::find($id);

        $posts = Post::all()->take(8);

        return view('post',['post'=>$post,'posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $product = Post::find($id);

         return view('update')->with('product',$product);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'price'=>'required',
            'category'=>'required',
            'image'=>'image|nullable|max:1999'
        ]);

        $nameToStore =null;
        $path = null;

        if($request->hasFile('image')){
            $nameWithExtension = $request->file('image')->getClientOriginalName();

            //name

            $fileName = pathinfo($nameWithExtension,PATHINFO_FILENAME);

            //extension

            $extension = $request->file('image')->getClientOriginalExtension();


            $nameToStore = $fileName.'_'.time().'.'.$extension;

            $path= $request->file('image')->storeAs('public/images',$nameToStore);

        }else{
            $nameToStore='noImage.jpg';
        }

        $post =Post::find($id);

        $post->title = $request->input('title');
        $post->description = $request->input('desc');
        $post->price = $request->input('price');
        $post->quantity = $request->input('quantity');
        $post->vendor = $request->input('vender');
        $post->category = $request->input('category');

        if($nameToStore!=='noImage.jpg')
            $post->image=$nameToStore;
        $post->save();

        session()->flash('success','Product Updated Successfully ');

        return redirect('/dashboard/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
