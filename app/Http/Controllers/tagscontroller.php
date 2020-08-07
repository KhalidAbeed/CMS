<?php

namespace App\Http\Controllers;
use App\Http\Requests\createtagrequest;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class tagscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index',['tags'=>Tag::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createtagrequest $request)
    {

        Tag::create([
            'name' =>$request->name
        ]);
        return redirect(route('tags.index'))->with('tags');
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
    public function edit(Tag $Tag)
    {
        return view('tags.create')->with('tags',$Tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $Tag)
    {
        $Tag->name=$request->name;
        $Tag->save();
        return redirect(route('tags.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $Tag)
    {
        if($Tag->posts->count()>0)
        {
            session()->flash('error','this tag is related to post');
            return redirect()->back();
        }else
        $Tag->delete();
        return redirect(route('tags.index'));
    }
}
