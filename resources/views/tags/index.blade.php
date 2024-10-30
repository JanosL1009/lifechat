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
                <div>
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Létrehozás</a> <!-- Gomb a jobb oldalon -->
                </div>
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
                        <th>Címke neve</th>
                        <th>Címke színe</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <div style="width: 20px; height: 20px; background-color: {{ $tag->color }}; border: 1px solid #000; margin: 0 auto;"></div> <!-- Középre igazítva -->
                        </td>
                        <td>
                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning">Szerkesztés</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
