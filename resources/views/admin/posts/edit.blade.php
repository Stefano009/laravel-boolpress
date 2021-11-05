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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection