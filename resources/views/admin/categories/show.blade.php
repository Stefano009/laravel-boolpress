@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione la categoria {{$category->id}}</h1>
                <h2>{{ $category->name }}</h2>
                <div>the slug is: {{ $category->slug }}</div>
            </div>
            <div class="col-12">
                <h2>lista dei post</h2>
                <ul>
                    @foreach ($category->posts as $post)
                    <li>
                        <a href="{{route('admin.posts.show', $post['slug'])}}">
                            {{$post->title}}
                        </a>    
                    </li>                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection