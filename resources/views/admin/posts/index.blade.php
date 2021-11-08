@extends('layouts.dashboard')

@section('content')
    <table>
        <thead>
            <tr>
                <th class="px-5" scope="col">#</th>
                <th class="px-5" scope="col">Title</th>
                <th class="px-5" scope="col">Slug</th>
                <th class="px-5" scope="col">Category</th>
                <th class="px-5" scope="col">Actions</th>
            </tr>
        </thead>
        @foreach ($posts as $post)
            <tr>
                <td scope="row">{{ $post['id'] }}</td>
                <td class="px-5">{{ $post['title'] }}</td>
                <td class="px-5">{{ $post['slug'] }}</td>
                <td class="px-5">{{ $post->category->name }}</td>
                {{-- to use the function category i need to see it as a variable of my posts and then call the variables of my categories, i could have called the id or the slug --}}
                <td>
                    <a href="{{ route('admin.posts.show', $post['slug']) }}"
                        class="btn btn-info">
                        Details
                    </a>
                    <a href="{{ route('admin.posts.edit', $post['id']) }}"
                        class="btn btn-warning">
                        Modify
                    </a>
                    <form class="d-inline-block delete-post" action="{{route('admin.posts.destroy', $post['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger">Delete</button>
                        {{-- to delete we need to create a button with destroy destination instead of a view that after deleting redirect you on a page of your choice in destroy method.  --}}
                    </form> 
                </td>
            </tr>
        @endforeach
    </table>
@endsection
