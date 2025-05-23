@extends('layouts.app-master')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Edit News</h2>
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

    <form action="{{ route('news.update', ['id' => $news->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Titolo:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Titolo" value="{{$news->title}}">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Testo:</strong>
                    <input type="text" name="text" class="form-control" placeholder="Testo" value="{{$news->text}}">
                    @error('text')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="active" value="1" class="form-control" id="flexRadioDefault1" {{($news->active== 1)? "checked" : "" }}>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Attivo
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="active" value="0" class="form-control" id="flexRadioDefault2" {{($news->active==0)? "checked" : "" }} >
                    <label class="form-check-label" for="flexRadioDefault2">
                        Non attivo
                    </label>
                    @error('active')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="pull-right mb-2 mt-2">
                <a class="btn btn-success" href="{{ route('news.index') }}"> Indietro</a>
                <button type="submit" class="btn btn-primary ml-3 mt-1">Modifica</button>
            </div>

        </div>
    </form>

@endsection
