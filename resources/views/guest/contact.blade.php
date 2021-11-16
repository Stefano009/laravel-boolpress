@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                Contatti
            </h1>
            <form action="{{route('contact.send')}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name"> NOME </label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email"> EMAIL </label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message"> MESSAGGIO </label>
                    <textarea name="message" id="message" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Invia">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection