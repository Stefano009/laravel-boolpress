@extends('layouts.dashboard')

@section('content')
    <table>
        <thead>
            <tr>
                <th class="px-5" scope="col">#</th>
                <th class="px-5" scope="col">Name</th>
                <th class="px-5" scope="col">Slug</th>
                <th class="px-5" scope="col">Actions</th>
            </tr>
        </thead>
        @foreach ($tags as $tag)
            <tr>
                <td scope="row">{{ $tag['id'] }}</td>
                <td class="px-5">{{ $tag['name'] }}</td>
                <td class="px-5">{{ $tag['slug'] }}</td>                
                <td class="">
                    <a  href="{{ route('admin.tags.show', $tag['id']) }}"
                        class="btn btn-info mx-1">
                        Details
                    </a>
                    {{-- <a  href="{{ route('admin.categories.edit', $tag['id']) }}"
                        class="btn btn-warning mx-1">
                        Modify
                    </a>
                    <form class=" mx-1 d-inline-block delete-tag" action="{{route('admin.categories.destroy', $tag['id'])}}" method="tag">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger">Delete</button>
                    </form>  --}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
