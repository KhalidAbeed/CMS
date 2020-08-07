@extends('layouts.app')
@section('content')
<form method="post" action="{{route('contacted')}}">
    @csrf
    <div class="form-group">
        <input class="form-control" name="email" type="text" >
    </div>
    <input type="submit" class="btn btn-success">
</form>
@endsection
