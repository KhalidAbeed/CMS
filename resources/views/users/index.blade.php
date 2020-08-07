@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table">
                <thead class="">
                <tr>
                    <td>Avatar</td>

                    <td>Email</td>
                    <td>Role</td>
                    <td></td>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tbody>
                    <tr>
                        <td>
                            <img src="{{ Gravatar::src($user->email)}}" alt=""
                            style="border-radius: 50%;height: 70px;width: 70px">
                        </td>

                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                       <td>
                            @if(!$user->isAdmin())
                               <form method="post" action="{{route('admins',$user->id)}}">
                                   @csrf
                                   <button type="submit" class="btn btn-success">Make Admin</button>
                               </form>

                            @endif
                       </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
