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
            <table id="patriziTable" class="display table table-striped table-bordered mb-2">
                <thead>
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
                    <th>Azioni</th>

                </tr>
                </thead>
            </table>



    </div>
    {{--  {!! $patrizi->links('pagination::bootstrap-4') !!}--}}

@endsection
@section('scripts')

    <script>
        function confirmDelete() {
            return confirm('Sei sicuro di voler eliminare questo patrizio?');
        }


        $(document).ready(function () {
            $('#patriziTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('patrizi.data') }}",
                order: [],
                language: {
                    "url": "{{ asset('assets/datatables/it-IT.json') }}"
                },
                columns: [
                    {data: 'register_number'},
                    {data: 'firstname'},
                    {data: 'lastname'},
                    {
                        data: 'birth',
                        render: function (data, type, row) {
                            if (data) {
                                let date = new Date(data);
                                return date.toLocaleDateString('it-IT');
                            }
                            return '';
                        }
                    },
                    {
                        data: 'living',
                        render: function (data, type, row) {
                            if (data) {
                                return 'Sì';
                            } else
                                return 'No';
                        }
                    },
                    {
                        data: 'death',
                        render: function (data, type, row) {
                            if (data && data !== '1900-01-01') {
                                let date = new Date(data);
                                return date.toLocaleDateString('it-IT');
                            }
                            return '';
                        }
                    },
                    {
                        data: 'patriziato_lost',
                        render: function (data, type, row) {
                            if (data && data !== '1900-01-01') {
                                let date = new Date(data);
                                return date.toLocaleDateString('it-IT');
                            }
                            return '';
                        }
                    },
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'street'},
                    {
                        data: 'zip',
                        render: function (data, type, row) {
                            if (data && data !== 0) {
                                return data;
                            }
                            return '';
                        }
                    },
                    {data: 'city'},
                    {
                        data: 'picture',
                        render: function (data, type, row) {
                            if (data) {
                                return `<img src="/storage/${data}" alt="Foto" width="100">`;
                            }
                            return '';
                        }
                    },
                    {data: 'note'},
                    {data: 'created_at'},
                    {
                        data: null, // Colonna per il bottone Modifica
                        render: function(data, type, row) {
                            // Crea il bottone con l'ID del record
                            return '<button class="btn btn-warning edit-btn" data-id="'+ row.id +'">Modifica</button>';
                        }
                    }
                ],

            });
        });

        $(document).on('click', '.edit-btn', function() {
            var patrizio = $(this).data('id');
            window.location.href = '/patrizi/' + patrizio + '/edit';
        });


    </script>
@endsection
