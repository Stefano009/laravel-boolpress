@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                <h1>tag number {{$tag->id}}</h1>
                <h2> tag name {{ $tag->name }}</h2>
                <div>the slug is: {{ $tag->slug }}</div>
            </div>
            <div class="col-12">
                <h2>lista dei post</h2>
                <ul>
                    @forelse ($tag->posts as $post)
                    <li>
                        <a href="{{route('admin.posts.show', $post['slug'])}}">
                            {{-- i use the slug 'cause i passed the slug in the post controller show if i want the id i need to change the controller show  --}}

                            {{$post->title}}
                        </a>    
                    </li>     
                    @empty
                        <h3>-- Nessun post da visualizzare --</h3>                  
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection