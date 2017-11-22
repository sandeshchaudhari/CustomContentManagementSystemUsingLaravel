@extends('layouts.admin');


@section('content')


    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        <tbody>
        @if($users)
            @foreach($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{($user->is_active)==1?'Active':'Not Active'}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>

        </tr>
        @endforeach
            @endif
        </tbody>
    </table>



@endsection