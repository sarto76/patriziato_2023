@extends('layouts.app-master')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Crea nuovo Patrizio</h2>
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

    <form action="{{ route('patrizi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Numero registro:</strong>
                    <input type="text" name="register_number" class="form-control" placeholder="Numero registro"
                           value="{{ old('register_number') }}">
                    @error('register_number')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Firstname -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome:</strong>
                    <input type="text" name="firstname" class="form-control" placeholder="Nome"
                           value="{{ old('firstname') }}">
                    @error('firstname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Lastname -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cognome:</strong>
                    <input type="text" name="lastname" class="form-control" placeholder="Cognome"
                           value="{{ old('lastname') }}">
                    @error('lastname')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Birth -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Data di nascita:</strong>
                    <input type="date" name="birth" class="form-control" placeholder="Data di nascita"
                           value="{{ old('birth') }}">
                    @error('birth')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Living (Checkbox) -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Vivente:</strong>
                    <input type="hidden" name="living" value="1">
                    <input type="checkbox" name="living" value="1" checked>
                    @error('living')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Padre:</strong>

                    <label for="father_input">Padre</label>
                    <input type="checkbox" id="father_is_patrizio" name="father_is_patrizio" value="1" checked>
                    <label for="father_is_patrizio">È patrizio?</label>
                    <select id="father_input" class="form-control mt-1" name="father_name" style="width: 100%"></select>
                    <input type="hidden" name="father_id" id="father_id" value="0">

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Madre:</strong>

                            <label for="mother_input">Madre</label>
                            <input type="checkbox" id="mother_is_patrizia" name="mother_is_patrizia" value="1" checked>
                            <label for="mother_is_patrizia">È patrizia?</label>
                            <select id="mother_input" class="form-control mt-1" name="mother_name"
                                    style="width: 100%"></select>
                            <input type="hidden" name="mother_id" id="mother_id" value="0">
                        </div>

                        <!-- Phone -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Telefono:</strong>
                                    <input type="text" name="phone" class="form-control" placeholder="Telefono"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Street -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Via:</strong>
                                    <input type="text" name="street" class="form-control" placeholder="Via"
                                           value="{{ old('street') }}">
                                    @error('street')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Zip -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>NAP:</strong>
                                    <input type="text" name="zip" class="form-control" placeholder="NAP"
                                           value="{{ old('zip') }}">
                                    @error('zip')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Città:</strong>
                                    <input type="text" name="city" class="form-control" placeholder="Città"
                                           value="{{ old('city') }}">
                                    @error('city')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Picture -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Foto:</strong>
                                    <input type="file" name="picture" class="form-control">
                                    @error('picture')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Note -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Note:</strong>
                                    <textarea name="note" class="form-control" rows="4"
                                              placeholder="Note">{{ old('note') }}</textarea>
                                    @error('note')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a class="btn btn-success" href="{{ route('patrizi.index') }}"> Indietro</a>
                                <button type="submit" class="btn btn-primary">Aggiungi</button>
                            </div>
                        </div>
    </form>

@endsection


@section('scripts')
    <script>
        $(document).ready(function () {

            setupSelect2WithToggle('mother_input', 'mother_is_patrizia', 'mother_id', '/patrizi/search');
            setupSelect2WithToggle('father_input', 'father_is_patrizio', 'father_id', '/patrizi/search');



            /* ============================
               CHANGE HANDLER MADRE
            ============================ */

            $('#mother_input').on('change select2:select select2:unselect', function () {

                const selectedValue = $(this).val();
                const selectedOption = $(this).find(':selected');

                // Aggiorna hidden
                $('#mother_id').val(selectedValue);

                if (!selectedValue) {
                    $('#mother_is_patrizia').prop('checked', false);
                    return;
                }

                const isManualInput = selectedOption.data('select2-tag') === true;
                const isExtern = selectedOption.data('is-extern') === true;

                if (isManualInput || isExtern) {
                    $('#mother_is_patrizia').prop('checked', false);
                } else {
                    $('#mother_is_patrizia').prop('checked', true);
                }

            });



            /* ============================
               CHANGE HANDLER PADRE
            ============================ */

            $('#father_input').on('change select2:select select2:unselect', function () {

                const selectedValue = $(this).val();
                const selectedOption = $(this).find(':selected');

                // Aggiorna hidden
                $('#father_id').val(selectedValue);

                if (!selectedValue) {
                    $('#father_is_patrizio').prop('checked', false);
                    return;
                }

                const isManualInput = selectedOption.data('select2-tag') === true;
                const isExtern = selectedOption.data('is-extern') === true;

                if (isManualInput || isExtern) {
                    $('#father_is_patrizio').prop('checked', false);
                } else {
                    $('#father_is_patrizio').prop('checked', true);
                }

            });


        });


        /* ============================
           FUNZIONE GENERICA SELECT2
        ============================ */

        function setupSelect2WithToggle(inputId, checkboxId, hiddenId, searchUrl) {

            $('#' + inputId).select2({
                placeholder: 'Scrivi un nome',
                allowClear: true,
                tags: true,
                minimumInputLength: 1,
                ajax: {
                    url: searchUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {q: params.term};
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(p => ({
                                id: p.id,
                                text: p.firstname + ' ' + p.lastname,
                                is_extern: false // risultati ajax sono patrizi
                            }))
                        };
                    },
                    cache: true
                }
            })
                .on('select2:select', function (e) {

                    $('#' + hiddenId).val(e.params.data.id);

                    // Se arriva da ajax è patrizio → checkbox checked
                    $('#' + checkboxId).prop('checked', true);
                })
                .on('select2:clear', function () {

                    $('#' + hiddenId).val('');
                    $('#' + checkboxId).prop('checked', false);
                });

        }
    </script>
@endsection

