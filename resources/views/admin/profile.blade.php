@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    i tuoi dati
                </div>
                <div class="card-body">
                    <div>
                        {{ Auth::user()->name }}
                    </div>
                    <div>
                        {{ Auth::user()->email }}
                    </div>
                    @if (Auth::user()->api_token)
                    <div>
                        {{ Auth::user()->api_token }}
                    </div>
                    @else
                        <form action="{{ route('admin.generate_token') }}" method="post">
                            @csrf
                            
                            <button class="btn btn-primary" type="submit">
                                genera API token
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
