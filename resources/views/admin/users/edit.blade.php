@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>
    @if($user && $user->has('photo'))
    <div class="col-md-3">
        <img src="{{($user->photo)?'/images/'.$user->photo->file_name:'No Profile Photo'}}" class="img-responsive img-responsive">
    </div>
    @endif
    <div class="col-md-9">
        <form method="POST" action="/admin/users/{{$user->id}}"  enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Enter your name">

                @if ($errors->has('name'))
                    <span class="help-block">
                             <strong>{{ $errors->first('name') }}</strong>
                         </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Enter your email">

                @if ($errors->has('email'))
                    <span class="help-block">
                             <strong>{{ $errors->first('email') }}</strong>
                         </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                @if ($errors->has('password'))
                    <span class="help-block">
                             <strong>{{ $errors->first('password') }}</strong>
                         </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                <label for="role">Role:</label>
                <select name="role_id" class="form-control" id="role_id" value="{{$user->role}}" required>
                    <option>Choose Option</option>

                    @foreach($roles as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>

                @if ($errors->has('role_id'))
                    <span class="help-block">
                             <strong>{{ $errors->first('role_id') }}</strong>
                         </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                <label for="status">Status:</label>
                <select name="is_active" id="" class="form-control">
                    @if($user->is_active==1)
                        <option value="0" selected>Not Active</option>
                    @else
                        <option value="1">Active</option>
                    @endif
                </select>
                @if ($errors->has('is_active'))
                    <span class="help-block">
                             <strong>{{ $errors->first('is_active') }}</strong>
                         </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('photo_id') ? ' has-error' : '' }}">
                <input type="file" id="photo_id" name="photo_id">
                <p class="help-block">Upload your profile picture.</p>
                @if ($errors->has('is_active'))
                    <span class="help-block">
                             <strong>{{ $errors->first('photo_id') }}</strong>
                         </span>
                @endif
            </div>

            <button class="btn btn-primary" type="submit" name="submit">Update User</button>
        </form>
    </div>

    @endsection