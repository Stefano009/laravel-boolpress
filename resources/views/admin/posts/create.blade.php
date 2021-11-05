@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf 
        @method('POST')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="inserisci il tuo titolo" value="{{ old('title') }}">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection