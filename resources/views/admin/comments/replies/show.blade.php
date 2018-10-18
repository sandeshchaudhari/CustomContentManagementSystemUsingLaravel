@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0)

        <h1>Replies from Comments</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Email</th>
                <th>reply</th>
                <th>Date Posted</th>
                <th>Post</th>
            </tr>
            </thead>
            <tbody>

            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>
                    <td>
                        @if($reply->is_active == 1)
                        <form method="post" action="/admin/comments/replies/{{$reply->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="is_active" value="0">
                            <input type="submit" value="Un-approve" class="btn btn-info">
                        </form>

                        @else
                        <form method="post" action="/admin/comments/replies/{{$reply->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="is_active" value="1">
                            <input type="submit" value="Approve" class="btn btn-success">
                        </form>
                        @endif
                    </td>

                    <td>
                        <form method="post" action="/admin/comments/replies/{{$reply->id}}">
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

        <h3 class="text-center">No replies</h3>

    @endif

@stop