@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method('POST')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="inserisci il tuo titolo" value="{{ 
            old('title') }}">
            @error('title')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror     
        </div>
        <div class="form-group">
            <label for="content">content</label>
            {{-- <input type="text" name="content" class="form-control" id="content" placeholder="Enter comic book content"> --}}
            <textarea class="form-control" id="content" name="content" placeholder="scrivi qui il tuo post...">{{ old('content') }}</textarea>
            @error('content')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror
        </div>
        <input type="file" name='image' id='image' class="@error('image') is-invalid @enderror">
        @error('image')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
           <label for="category_id">Category</label> 
           <select name="category_id" id="category_id">
               <option value="">Select the category</option>
               @foreach ($categories as $category)
               
               <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : null}}>{{ $category->name }}</option> 
                {{-- selected as default is on the first option, using a ternary i will check with the old if my value was correctly selected and maintain it --}}
                @endforeach
           </select>
        </div>
        <div class="form-group">
           <p>select the tag</p> 
           @foreach ($tags as $tag)
           <div class="form-check form-check-inline">
            <input 
            {{ in_array($tag->id, old('tags', [])) ? 'checked' : null }}
            value="{{ $tag->id }}" type="checkbox" id="{{ 'tag' . $tag->id }}" name="tags[]" class="form-check-input">
            {{-- name='tags[]' setted as array let me harvest all the checked boxes  --}}
            <label class="form-check-label" for="{{ 'tag' . $tag->id }}"> {{ $tag->name }} </label>
        </div>   
        @endforeach
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

{{-- @if ($errors->any())
            <input
            {{-- in caso di errore devo per forza usare l'if e fare due bottoni diversi, poi uso l'old e passo tags come array--}}
            {{-- {{ in_array($tag->id, old('tags', [])) ? 'checked' : null }}
            value="{{ $tag->id }}" type="checkbox" id="{{ 'tag' . $tag->id }}" name="tags[]" class="form-check-input">
            {{-- name='tags[]' setted as array let me harvest all the checked boxes  --}}
            {{-- <label class="form-check-label" for="{{ 'tag' . $tag->id }}"> {{ $tag->name }} </label>
            @else
            <input value="{{ $tag->id }}" type="checkbox" id="{{ 'tag' . $tag->id }}" name="tags[]" class="form-check-input">
            {{-- name='tags[]' setted as array let me harvest all the checked boxes  --}}
            {{-- <label class="form-check-label" for="{{ 'tag' . $tag->id }}"> {{ $tag->name }} </label>
            @endif  --}}