@extends('layouts.admin');


@section('content')
    @if(\Illuminate\Support\Facades\Session::has('deleted_user'))

    <p class="bg-success">{{session('deleted_user')}}</p>

    @endif



    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th>
            <th>User Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit User</th>
            <th>Delete User</th>
        </tr>
        <tbody>
        @if($users)
            @foreach($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td><img height="50px" width="50px" src="{{($user->photo)?'/images/'.$user->photo->file_name:'No Profile Photo'}}"> </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{($user->is_active)==1?'Active':'Not Active'}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td><a href="/admin/users/{{$user->id}}/edit">Edit</a> </td>
            <td>
            <form method="post" action="/admin/users/{{$user->id}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="DELETE">
                <!--<td><a href="/admin/users/{{$user->id}}">Delete</a> </td> -->
            </form>
            </td>


        </tr>
        @endforeach
            @endif
        </tbody>
    </table>



@endsection