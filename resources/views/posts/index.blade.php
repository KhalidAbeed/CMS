@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-right" href="{{route('posts.create')}}">Add new Post</a>
            <h1>All Posts</h1>
        </div>
        <div class="card-body">
            @if($posts->count()>0)
            <table class="table">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Content</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
             @foreach($posts as $post)
                <tbody>
                    <tr>
                        <td>
                            <img style="height: 50px;width: 100px"
                                 src="{{asset('storage/'.$post->image)}}">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->category->name}}</td>
                        @if(!$post->trashed())
                        <td><a href="{{route('posts.edit',$post->id)}}" class="btn btn-success">Edit</a></td>
                       @endif
                            <td>
                            <form method="post" action="{{route('posts.destroy',$post->id)}}">
                               @csrf
                                @method('Delete')
                                <button class="btn btn-danger">
                                    {{$post->trashed()? 'Delete' :'Trash'}}
                                </button>
                            </form>
                            </td>
                            <td>
                               @if($post->trashed())
                                    <form method="post" action="{{route('restored',$post->id)}}">
                                        @csrf
                                        @method('Put')
                                        <button class="btn btn-danger">
                                            Restore
                                        </button>
                                    </form>
                                   @endif
                        </td>
                    </tr>
                </tbody>
             @endforeach
            </table>

            @else
                    <h2 class="text-center">No Posts yet</h2>
            @endif
        </div>
    </div>
    @endsection
