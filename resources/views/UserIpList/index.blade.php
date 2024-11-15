@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="lifechatlogo">
            <img src="{{ asset('images/lifechat.gif') }}" alt="">
        </div>      
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-3 roomtitle">
                <h1>Felhasználó IP lista</h1>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.UserLogs.export') }}" class="btn btn-primary me-2">Adatok exportálása</a>
                    <a href="{{route('admin.UserLogs.search.user.list')}}" class="btn btn-primary">Keresés</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Neve</th>
                        <th>Email cím</th>
                        <th>Ip címe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($useriplist as $userlist)
                    <tr>
                        <td>{{ $userlist->user->name }}</td>
                        <td>{{ $userlist->user->email }}</td>
                        <td>{{$userlist->ip_address}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $useriplist->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
