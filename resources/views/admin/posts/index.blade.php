@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post['id'] }}</th>
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
                        <form action="{{route('admin.posts.destroy', $post['id'])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                            {{-- to delete we need to create a button with destroy destination instead of a view that after deleting redirect you on a page of your choice in destroy method.  --}}
                        </form> 
                    </td>
                </tr>
            @endforeach
        </div>
    </div>
</div>
@endsection
