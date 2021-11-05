@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.update', $post['id'])}}" method="post">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
            @error('content')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror     
        </div>
        <div class="form-group">
            <label for="content">content</label>
            {{-- <input type="text" name="content" class="form-control" id="content" placeholder="Enter comic book content"> --}}
            <textarea class="form-control" id="content" name="content" >{{ old('content') }}</textarea>
            @error('content')
            <div class="alert alert-danger"> {{ $message }} </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection