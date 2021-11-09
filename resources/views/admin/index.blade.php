@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-5">
        <div class="col-6 d-flex justify-content-around">
            <a  href="{{ route('admin.posts.index')}} "
                class="btn btn-success mx-1">
                Posts
            </a>
            <a  href="{{ route('admin.categories.index') }}"
                class="btn btn-info mx-1">
                Categories
            </a>
            <a  href="{{ route('admin.tags.index') }}"
                class="btn btn-danger mx-1">
                Tags
            </a>
        </div>
    </div>
</div>
@endsection
