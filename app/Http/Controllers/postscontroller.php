<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class postscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('checkcategory')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',['posts'=>Post::all()])
            ->with('categories',Category::all())
            ->with('tags',Tag::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create',['posts',Post::all()])
            ->with('tags',Tag::all())->with('categories',Category::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

       $request->validate([
            'title'=>'required|unique:posts',
            'description'=>'required',
            'content'=>'required',
            'image'=>'required'

        ]);
       $image=$request->image->store('images','public');
       $post=Post::create([
           'title'=>$request->title,
            'description'=>$request->description,
            'content'=>'OMER',
            'image'=>$image,
           'category_id'=>$request->category
       ]);
       if($request->tags)
       {
           $post->tags()->attach($request->tags);

       }
       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('posts',$post)->with('categories',Category::all())
            ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($request->hasFile('image'))
        {

            $image=$request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $post->image=$image;
        }
        $post->title=$request->title;
        $post->description=$request->description;
        $post->content='lol';
        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }
        $post->save();
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed())
        {
            Storage::disk('public')->delete($post->image);
            $post->forceDelete();
        }else
        $post->delete();
        return redirect(route('posts.index'));
    }

    public function trashed()
    {

        $trashed=Post::onlyTrashed()->get();
        return view('posts.index',['posts'=>$trashed]);
    }

    public function restore($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        return redirect(route('posts.index'));
    }




}
