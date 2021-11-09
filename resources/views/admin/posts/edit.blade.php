@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.update', $post['id'])}}" method="post">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $post['title']) }}">
            @error('title')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror     
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea class="form-control" id="content" name="content" >{{ old('content' ,$post['content']) }}</textarea>
            @error('content')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category</label> 
            <select name="category_id" id="category_id" class=" form-control @error('category_id')is-invalid @enderror">
                <option value="" >Select the category</option>
                @foreach ($categories as $category)                
                <option value="{{ $category->id }}"
                {{-- pls care to the variables you are working on. category_id != category->id --}}
                 {{ old('category_id', $post->category_id) == $category->id ? 'selected' : null}}>{{ $category->name }}</option> 
                 {{-- selected as default is on the first option, using a ternary i will check with the old if my value was correctly selected and maintain it --}}
                 @endforeach
            </select>
         </div>
         <div class="form-group">
            <p>select the tag</p> 
            @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                @if ($errors->any())
                <input
                {{-- in caso di errore devo per forza usare l'if e fare due bottoni diversi, poi uso l'old e passo tags come array--}}
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : null }}
                value="{{ $tag->id }}" type="checkbox" id="{{ 'tag' . $tag->id }}" name="tags[]" class="form-check-input">
                {{-- name='tags[]' setted as array let me harvest all the checked boxes  --}}
                <label class="form-check-label" for="{{ 'tag' . $tag->id }}"> {{ $tag->name }} </label>
                @else
                <input
                {{-- inserisco un controllo per il checked  contains è un metodo che verifica che qualcosa sia contenuto all'interno del pivot
                $tag o $tag->id in contains funziona--}}
                {{ $post->tags->contains($tag->id) ? 'checked' : null }}
                value="{{ $tag->id }}" type="checkbox" id="{{ 'tag' . $tag->id }}" name="tags[]" class="form-check-input">
                {{-- name='tags[]' setted as array let me harvest all the checked boxes  --}}
                <label class="form-check-label" for="{{ 'tag' . $tag->id }}"> {{ $tag->name }} </label>
                @endif 
            </div>   
            @endforeach
         </div>
         <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection