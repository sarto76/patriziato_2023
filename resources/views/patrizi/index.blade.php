@extends('layouts.fullpage-master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>Catalogo elettorale</h2>
            </div>
            @auth
                <div class="pull-right mb-3">
                    <a class="btn btn-success" href="{{ route('patrizi.create') }}"> Nuovo Patrizio</a>
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

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Numero di Registro</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Data di Nascita</th>
                    <th>Vivente</th>
                    <th>Data Morte</th>
                    <th>Data perdita patriziato</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Indirizzo</th>
                    <th>Cap</th>
                    <th>Città</th>
                    <th>Foto</th>
                    <th>Note</th>
                    <th>Data Caricamento</th>
                    @auth
                        <th>Azioni</th>
                    @endauth
                </tr>
                </thead>
                <tbody>
                @foreach ($patrizi as $single)
                    <tr>
                        <td>{{ $single->registerNumber }}</td>
                        <td>{{ $single->firstName }}</td>
                        <td>{{ $single->LastName }}</td>
                        <td>{{ date('d.m.Y', strtotime($single->dateOfBirth)) }}</td>
                        <td>{{ ($single->isAlive == 1) ? "Si" : "No" }}</td>
                        <td>{{ date('d.m.Y', strtotime($single->dateOfDeath)) }}</td>
                        <td>{{ date('d.m.Y', strtotime($single->dateOfLoss)) }}</td>
                        <td>{{ $single->phone }}</td>
                        <td>{{ $single->email }}</td>
                        <td>{{ $single->address }}</td>
                        <td>{{ $single->cap }}</td>
                        <td>{{ $single->city }}</td>
                        <td><a href="{{ $single->photo }}" target="_blank">{{ $single->photo }}</a></td>
                        <td>{{ $single->notes }}</td>
                        <td>{{ date('d.m.Y', strtotime($single->created_at)) }}</td>
                        @auth
                            <td>
                                <form action="{{ route('patrizi.destroy', $single->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
    {!! $patrizi->links('pagination::bootstrap-4') !!}





@endsection

<script>
    function confirmDelete() {
        return confirm('Sei sicuro di voler eliminare questo patrizio?');
    }
</script>
