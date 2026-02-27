@extends('layouts.app-master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-3">
                <h2>Membri ufficio patriziale</h2>
            </div>
            @auth
                <div class="pull-right mb-3">
                    <a class="btn btn-success" href="{{ route('component.create') }}"> Nuovo Membro</a>
                </div>
            @endauth
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif



    <div class="m-2">

        <div class="row">
            @foreach ($components as $single)
                <div class="col-sm-6 mb-1">
                    <div class="card">
                        <img class="card-img-top img-fluid"
                             src="{{ asset('storage/' . $single->picture) }}"
                             style="max-height: 300px; object-fit: cover;">
                        <h5 class="card-header">{{$single->role}}</h5>
                        <div class="card-body">
                            <p class="card-text">{{$single->firstname}}</p>
                            <p class="card-text">{{$single->lastname}}</p>
                            <p>

                        </div>
                        @auth
                            <div class="m-1">
                                <a class="btn btn-primary" href="{{ route('component.edit',$single->id) }}">Edit</a>
                            </div>
                        @endauth

                        <div class="m-1">
                            <form action="{{ route('component.destroy',$single->id) }}" method="Post" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
    {!! $components->links('pagination::bootstrap-4') !!}


@endsection


<script>
    function confirmDelete() {
        return confirm('Sei sicuro di voler eliminare questa news?');
    }
</script>
