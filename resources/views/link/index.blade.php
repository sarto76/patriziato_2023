@extends('layouts.app-master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-3">
                <h2>Link</h2>
            </div>
            @auth
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('link.create') }}"> Nuovo Link</a>
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
            @foreach ($links as $single)
                <div class="col-sm-6 mb-1">
                    <div class="card">
                        <h5 class="card-header">{{$single->name}}</h5>
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{$single->url}}" target="_blank">{{$single->url}}</a>
                            </p>
                            <p class="card-text"><small class="text-muted">Caricato
                                    il: {{date('d.m.Y', strtotime($single->created_at))}}</small></p>
                        </div>
                        @auth
                            <div class="m-1">
                                <form action="{{ route('link.destroy',$single->id) }}" method="Post" onsubmit="return confirmDelete();">
                                    <a class="btn btn-primary" href="{{ route('link.edit',$single->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

            @endforeach
        </div>

    </div>
    {!! $links->links() !!}






@endsection

<script>
    function confirmDelete() {
        return confirm('Sei sicuro di voler eliminare questo link?');
    }
</script>
