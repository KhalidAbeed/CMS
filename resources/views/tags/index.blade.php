@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-right" href="{{route('tags.create')}}">Add new tag</a>
            <h1>All Product</h1>

        </div>
        <div class="card-body">
            <table class="table">
                <thead class="">
                <tr>
                    <td>Name</td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                @foreach($tags as $tag)
                    <tbody>
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->posts->count()}}</td>
                        <td><a href="{{route('tags.edit',$tag->id)}}" class="btn btn-success">Edit</a></td>
                        <td>
                            <form method="post" action="{{route('tags.destroy',$tag->id)}}">
                                @csrf
                                @method('Delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
