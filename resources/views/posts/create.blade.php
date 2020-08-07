@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
             {{isset($posts)?'Update post':'Add new post'}}
        </div>


@include('error&session.error')
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"
                  action="{{isset($posts)? route('posts.update',$posts->id):route('posts.store')}}">
                @csrf
                @if(isset($posts))
                    @method('Put')
                @endif

                <div class="form-group">
                    <label class="col-form-label">posts Title</label>
                    <input class="form-control" type="text"
                           name="title" value="{{isset($posts)?$posts->title:''}}">
                </div>

                <div class="form-group">
                    <label class="col-form-label">posts description</label>
                    <textarea rows="5" cols="5" class="form-control"
                           name="description">
                        {{isset($posts)?$posts->description:''}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label>posts content</label>
                    <input class="form-control" id="content"
                           type="hidden" name="content"
                           value="{{isset($posts)?$posts->content:''}}">
                    <trix-editor input="content"></trix-editor>
                </div>


                @if(isset($posts))
                <div class="form-group">
                    <img src="{{asset('storage/'.$posts->image)}}">
                </div>
                @endif

                <div class="form-group">
                    <input type="file"
                           name="image">
                </div>

                <div class="form-group">
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>


        <div class="form-group">
            <select class="form-control" name="tags[]" multiple>
                @foreach($tags as $tag)
                  <option value="{{$tag->id}}"
                   @if(isset($posts))
                       @if(in_array($tag->id,$posts->tags->pluck('id')->toArray()))
                       selected
                       @endif
                   @endif
                    >
                        {{$tag->name}}
                   </option>
                @endforeach
            </select>
        </div>

                <input class="btn btn-primary" type="submit" value="{{isset($posts)? 'Update':'Add new post'}}">
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" rel="stylesheet">
@endsection
