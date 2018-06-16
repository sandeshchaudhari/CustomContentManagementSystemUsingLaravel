@extends('layouts.admin')

@section('content')

    <h1>Create Category</h1>


    <form method="POST" action="/admin/categories">
        {{csrf_field()}}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Title:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter post title">
            @if ($errors->has('name'))
                <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
            @endif
        </div>
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
    </form>
@endsection