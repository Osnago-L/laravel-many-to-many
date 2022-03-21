@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <div class="alert alert-success alert-dismissible fade show container" role="alert">
                <strong>You are logged in!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endauth
        <div class="d-flex justify-content-between">
            <h1>Lista Posts</h1>
            <a href="{{ route('admin.posts.create') }}"><button type="button" class="btn btn-warning">Add Post</button></a>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Content</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_posts as $element)
                    <tr>
                        <th scope="row">{{ $element->id }}</th>
                        <td>{{ $element->posts_title }}</td>
                        <td>{{ $element->category ? $element->category->name : '-' }}</td>
                        <td>{{ $element->content }}</td>
                        <td><a href="{{ route('admin.posts.show', $element->id) }}"><button type="button"
                                    class="btn btn-primary">Show</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
