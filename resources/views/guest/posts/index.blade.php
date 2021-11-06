@extends('layouts.app')

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
                    <a href="{{ route('posts.show', $post['slug']) }}"
                        class="btn btn-info">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
