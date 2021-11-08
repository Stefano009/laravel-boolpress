@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.store')}}" method="post">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection