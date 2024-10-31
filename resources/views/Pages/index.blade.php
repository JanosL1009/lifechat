@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="lifechatlogo">
            <img src="{{ asset('images/lifechat.gif') }}" alt="">
        </div>      
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 style="text-align:center;">Címkék</h1> 
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Oldal neve</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->name }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Szerkesztés</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
