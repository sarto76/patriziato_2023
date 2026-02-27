@extends('layouts.app-master')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Aggiungi Membro</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('component.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="firstname" class="form-control" placeholder="Nome" value="{{ old('firstname') }}" >
                    @error('firstname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cognome:</strong>
                    <input type="text" name="lastname" class="form-control" placeholder="Cognome" value="{{ old('lastname') }}" >
                    @error('lastname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Ruolo:</strong>
                    <input type="text" name="role" class="form-control" placeholder="Ruolo" value="{{ old('role') }}" >
                    @error('role')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Immagine attuale:</strong><br>

                    <br>
                    <strong>Immagine:</strong>
                    <input type="file" name="picture" class="form-control" placeholder="Immagine">

                    @error('picture')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="pull-right mb-2 mt-2">
                <a class="btn btn-success" href="{{ route('component.index') }}"> Indietro</a>
                <button type="submit" class="btn btn-primary ml-3 mt-1">Crea</button>
            </div>

        </div>
    </form>

@endsection
