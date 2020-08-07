@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-right" href="{{route('categories.create')}}">Add new Category</a>
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
             @foreach($categories as $category)
                <tbody>
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->posts->count()}}</td>
                        <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-success">Edit</a></td>
                        <td>
                            <form method="post" action="{{route('categories.destroy',$category->id)}}">
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
