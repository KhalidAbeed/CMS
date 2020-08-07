@extends('layouts.app')
@section('content')
    <div class="card bg-secondary">
        <div class="card-header">
            {{isset($tags)?'Update Product':'Add new Product'}}
        </div>
@include('error&session.error')
        <div class="card-body">
            <form method="post"
                  action="{{isset($tags)? route('tags.update',$tags->id):route('tags.store')}}">
                @csrf
                @if(isset($tags))
                    @method('Put')
                @endif

                <div class="form-group">
                    <label class="col-form-label">tag name</label>
                    <input class="form-control" type="text"
                           name="name" value="{{isset($tags)?$tags->name:''}}">
                </div>
                <input class="btn btn-primary" type="submit" value="{{isset($tags)? 'Update':'Add'}}">
            </form>
        </div>
    </div>
@endsection
