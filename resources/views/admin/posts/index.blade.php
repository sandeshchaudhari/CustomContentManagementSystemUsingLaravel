@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th>
            <th>User</th>
            <th>Photo_id</th>
            <th>Category_id</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit Post</th>
            <th>Delete Post</th>
        </tr>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->photo_id}}</td>
                    <td>{{$post->category_id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td><a href="/admin/posts/{{$post->id}}/edit">Edit</a> </td>
                    <td>
                        <form method="post" action="/admin/posts/{{$post->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE">
                        <!--<td><a href="/admin/posts/{{$post->id}}">Delete</a> </td> -->
                        </form>
                    </td>


                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @endsection