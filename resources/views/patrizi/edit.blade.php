@extends('layouts.app-master')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Edit Patrizio</h2>
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

    <form action="{{ route('patrizi.update', ['id' => $patrizio->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Numero registro:</strong>
                    <input type="text" name="register_number" class="form-control" placeholder="Numero registro" value="{{ $patrizio->register_number }}">
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
                    <input type="text" name="firstname" class="form-control" placeholder="Nome" value="{{ $patrizio->firstname }}">
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
                    <input type="text" name="lastname" class="form-control" placeholder="Cognome" value="{{ $patrizio->lastname }}">
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
                    <input type="date" name="birth" class="form-control" placeholder="Data di nascita" value="{{ $patrizio->birth }}">
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
                    <input type="hidden" name="living" value="0">
                    <input type="checkbox" name="living" value="1" {{ $patrizio->living == 1 ? 'checked' : '' }}>
                    @error('living')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Death -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Data morte:</strong>
                    <input type="date" name="death" class="form-control" placeholder="Data morte" value="{{ $patrizio->death }}">
                    @error('death')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Patriziato Lost -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Data perdita patrizio:</strong>
                    <input type="date" name="patriziato_lost" class="form-control" placeholder="Data perdita patrizio" value="{{ $patrizio->patriziato_lost }}">
                    @error('patriziato_lost')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Padre:</strong>

                   {{-- <select name="father_id" class="form-control">
                        <option value="">--</option>
                        @foreach($patrizi as $single)
                            <option value="{{ $single->id }}" {{ $patrizio->id == $single->father->id ? 'selected' : '' }}>{{ $single->firstname }} {{ $single->lastname }}</option>
                        @endforeach

                    </select>--}}

                    @foreach($patrizi as $single)
                        {{$single->id}} {{$single->firstname}} {{$single->lastname}} {{$single->father->id}} {{$patrizio->id}} <br>
                    @endforeach


                    <input type="checkbox" name="patriziato_lost" value="1" {{ $patrizio->patriziato_lost == 1 ? 'checked' : '' }}>
                    @error('patriziato_lost')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror

        </div>

        <!-- Phone -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefono:</strong>
                    <input type="text" name="phone" class="form-control" placeholder="Telefono" value="{{ $patrizio->phone }}">
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
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $patrizio->email }}">
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
                    <input type="text" name="street" class="form-control" placeholder="Via" value="{{ $patrizio->street }}">
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
                    <input type="text" name="zip" class="form-control" placeholder="NAP" value="{{ $patrizio->zip }}">
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
                    <input type="text" name="city" class="form-control" placeholder="Città" value="{{ $patrizio->city }}">
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
                    <textarea name="note" class="form-control" rows="4" placeholder="Note">{{ $patrizio->note }}</textarea>
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
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </div>
    </form>

@endsection
