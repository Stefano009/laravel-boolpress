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
        @foreach ($categories as $category)
            <tr>
                <td scope="row">{{ $category['id'] }}</td>
                <td class="px-5">{{ $category['name'] }}</td>
                <td class="px-5">{{ $category['slug'] }}</td>                
                <td class="">
                    <a  href="{{ route('admin.categories.show', $category['id']) }}"
                        class="btn btn-info mx-1">
                        Details
                    </a>
                    <a  href="{{ route('admin.categories.edit', $category['id']) }}"
                        class="btn btn-warning mx-1">
                        Modify
                    </a>
                    <form class=" mx-1 d-inline-block delete-category" action="{{route('admin.categories.destroy', $category['id'])}}" method="category">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger">Delete</button>
                    </form> 
                </td>
            </tr>
        @endforeach
    </table>
@endsection
