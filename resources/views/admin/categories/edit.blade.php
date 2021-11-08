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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection