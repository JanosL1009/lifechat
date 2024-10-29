@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="lifechatlogo">
            <img src="{{ asset('images/lifechat.gif') }}" alt="">
        </div>      
        <div class="row">
            <div class="roomtitle">
                <h1>Szobák</h1>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <th>Szoba neve</th>
                    <th>Szoba leírása</th>
                    <th>Státusz</th>
                    <th>Létszám</th>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->describe }}</td>
                        <td>{{ $room->status == 1 ? 'Aktív' : 'Inaktív' }}</td>
                        <td>{{ $room->number_of_employees }}</td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
