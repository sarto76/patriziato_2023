@extends('layouts.app-master')

@section('content')

    @guest
        <div class="bg-light p-5 rounded">
            <h1>Informazioni</h1>
            <p class="lead">{{$info->text}}</p>
        </div>
    @endguest
    @auth
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-1">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form action="{{ route('info.update', ['id' => $info->id]) }}" method="Post">
            @csrf
            @method('PUT')
            <div class="bg-light p-5 rounded">
                <h1>Informazioni</h1>
                <textarea cols="100" rows="10" name="text">{{$info->text}}</textarea>
                <div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </div>
        </form>
    @endauth
@endsection
