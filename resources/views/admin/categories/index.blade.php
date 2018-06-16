@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>
    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Edit Category</th>
            <th>Delete Category</th>
        </tr>
        <tbody>
        @if($categories)
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                    <td><a href="/admin/categories/{{$category->id}}/edit">Edit</a> </td>
                    <td>
                        <form method="post" action="/admin/categories/{{$category->id}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="DELETE">
                        <!--<td><a href="/admin/posts/{{$category->id}}">Delete</a> </td> -->
                        </form>
                    </td>


                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection