@extends('layouts.dashboard')

@section('content')
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        @foreach ($posts as $post)
            <tr>
                <td scope="row">{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{!! $post['slug'] !!}</td>
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
