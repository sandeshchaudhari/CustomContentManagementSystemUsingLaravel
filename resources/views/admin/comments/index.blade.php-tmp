@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0)

        <h1>Comments</h1>

    <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Date Posted</th>
            <th>Post</th>
            <th>Replies</th>
           </tr>
        </thead>
        <tbody>

        @foreach($comments as $comment)
           <tr>
             <td>{{$comment->id}}</td>
             <td>{{$comment->author}}</td>
             <td>{{$comment->email}}</td>
             <td>{{$comment->body}}</td>
             <td>{{$comment->created_at->diffForHumans()}}</td>
             <td><a href="{{route('home.post', $comment->post->slug)}}">View Post</a></td>
             <td><a href="{{route('replies.show', $comment->id)}}">View Replies</a> ({{count($comment->replies)}})</td>
             <td>
                 @if($comment->is_active == 1)

 						<form method="post" action="/admin/comment/{{$comment->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="is_active" value="0">
                            <input type="submit" value="Un-approve" class='btn btn-info'>
                        </form>

                     @else

                     <form method="post" action="/admin/comment/{{$comment->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="is_active" value="1">
                            <input type="submit" value="Approve" class="btn btn-success">
                        </form>

                 @endif
             </td>

             <td>
             	 <form method="post" action="/admin/comment/{{$comment->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE">
                        </form>



             </td>
           </tr>
        @endforeach

         </tbody>
    </table>

        @else

        <h3 class="text-center">No Comments</h3>

    @endif

@stop