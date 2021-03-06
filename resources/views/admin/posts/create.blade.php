@extends('layouts.admin')

@section('content')


<h1>Create Post</h1>


         <form method="POST" action="/admin/posts"  enctype="multipart/form-data">
             {{csrf_field()}}
             <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                 <label for="title">Title:</label>
                 <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
                 @if ($errors->has('title'))
                     <span class="help-block">
                         <strong>{{ $errors->first('title') }}</strong>
                     </span>
                 @endif
             </div>



             <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                 <label for="user_id">User:</label>
                 <input type="text" class="form-control" id="user_id" name="user_id" value="{{$user->name}}" placeholder="Enter your user_id">
                 @if ($errors->has('user_id'))
                     <span class="help-block">
                         <strong>{{ $errors->first('user_id') }}</strong>
                     </span>
                 @endif
             </div>

             <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                 <label for="category_id">category:</label>
                 <select name="category_id" id="category_id" class="form-control" required>
                     <option>Choose Option</option>
                     @foreach($categories as $key=>$value)
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                 </select>
                 @if ($errors->has('category_id'))
                     <span class="help-block">
                         <strong>{{ $errors->first('category_id') }}</strong>
                     </span>
                 @endif
             </div>

             <div class="form-group{{ $errors->has('photo_id') ? ' has-error' : '' }}">
                 <input type="file" id="photo_id" name="photo_id">
                 <p class="help-block">Upload photo.</p>
                 @if ($errors->has('photo_id'))
                     <span class="help-block">
                         <strong>{{ $errors->first('photo_id') }}</strong>
                     </span>
                 @endif
             </div>

             <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                 <label for="body">Comment:</label>
                 <textarea class="form-control" rows="5" id="body" name="body"></textarea>

                 @if ($errors->has('body'))
                     <span class="help-block">
                         <strong>{{ $errors->first('body') }}</strong>
                     </span>
                 @endif
             </div>

             <button type="submit" class="btn btn-default" name="submit">Submit</button>
         </form>
         @include('includes.tinymce')
    @endsection