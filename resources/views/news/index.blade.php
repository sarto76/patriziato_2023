@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>News</h2>
                </div>
                @auth
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('news.create') }}"> Nuova News</a>
                </div>
                    @endauth
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-borderless">
            <tbody>
            @foreach ($news as $single)
                <tr>
                    <td>{{ $single->title }}</td>
                    <td>{{ $single->text }}</td>
                    <td>{{ $single->active }}</td>
                    <td>{{ $single->created_at }}</td>
                    @auth
                    <td>
                        <form action="{{ route('news.destroy',$single->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('news.edit',$single->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $news->links() !!}
    </div>





        @auth
            <h1>Dashboard</h1>
            <p class="lead">Only authenticated users can access this section.</p>
            <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        @endauth

    </div>
@endsection
