@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <h4>Nome Post:</h6>
        <span>{{$post->posts_title}}</span>
    </div><br>
    <div>
        <h4>Categoria:</h6>
        <span>{{$post->category ? $post->category->name : "-"}}</span>
    </div><br>
    <div>
        <h4>Contenuto Post:</h6>
        <span>{{$post->content}}</span>
    </div><br><br>
    <div class="d-flex">
        <a class="mr-2" href="{{route('admin.posts.edit',$post->id)}}"><button type="button" class="btn btn-secondary">Edit</button></a>
        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" onclick="return confirm('Are you sure?');" type="submit" value="Delete">
        </form>
    </div>
</div>
@endsection