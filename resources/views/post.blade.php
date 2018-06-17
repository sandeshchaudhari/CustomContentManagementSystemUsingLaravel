@extends('layouts.blog-post')



@section('content')
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{\Illuminate\Support\Facades\URL::to('/')}}/images/{{$post->photo->file_name}}" alt="Post image">

        <hr>

        <!-- Post Content -->
        <p class="lead">{{$post->body}} </p>

        <hr>

        <!-- Blog Comments -->
@if(Session::has('comment_message'))
    {{Session('comment_message')}}
    @endif

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form method="POST" action="/admin/comment" >
                {{csrf_field()}}
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <textarea class="form-control" rows="5" id="body" name="body"></textarea>

                    @if ($errors->has('body'))
                        <span class="help-block">
                         <strong>{{ $errors->first('body') }}</strong>
                     </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->
@if($comments)
    @foreach($comments as $comment)
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->author}}
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                </h4>
                {{$comment->body}}
                @if($comment->has('replies'))
                    @foreach($comment->replies as $reply)
                    <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    @endforeach
                    @endif
            </div>
        </div>
@endforeach
    @endif

    </div>
    @endsection