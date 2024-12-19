@extends('layouts.app-master')

@section('content')
    @guest
        <div class="bg-light p-5 rounded">
            <h1>Informazioni</h1>
            <p class="lead">{{$info->text}}</p>
        </div>
    @endguest
    @auth

        <form action="{{ route('info.update', ['id' => $info->id]) }}" method="Post">
            <div class="bg-light p-5 rounded">
                <h1>Informazioni</h1>
                <textarea cols="100">{{$info->text}}</textarea>
            </div>
        </form>
    @endauth
@endsection
