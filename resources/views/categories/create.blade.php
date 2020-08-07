@extends('layouts.app')
@section('content')
    <div class="card bg-secondary">
        <div class="card-header">
             {{isset($categories)?'Update Product':'Add new Product'}}
        </div>
 @include('error&session.error')
        <div class="card-body">
            <form method="post"
                  action="{{isset($categories)? route('categories.update',$categories->id):route('categories.store')}}">
                @csrf
                @if(isset($categories))
                    @method('Put')
                @endif

                <div class="form-group">
                    <label class="col-form-label">Category name</label>
                    <input class="form-control" type="text"
                           name="name" value="{{isset($categories)?$categories->name:''}}">
                </div>
                <input class="btn btn-primary" type="submit" value="{{isset($categories)? 'Update':'Add'}}">
            </form>
        </div>
    </div>
@endsection
