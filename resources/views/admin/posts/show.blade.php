@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{$post->id}}</h1>
                <h2>{{ $post->title }}</h2>
                <h2>{{ $post->content }}</h2>
                <p>{{ $post->content }}</h2>
                @if ($post->cover)
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">                    
                @endif
                <div>the slug is: {{ $post->slug }}</div>
            </div>
        </div>
    </div>
@endsection