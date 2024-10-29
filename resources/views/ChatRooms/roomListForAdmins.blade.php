@extends('layouts.app')
@section('content')
<style>
    .lifechatlogo{
        text-align: center;
        height: 130px;
        width: auto;
    }
    .roomtitle{
        text-align: center;
    }
</style>
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
                    <th>Műveletek</th>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->describe }}</td>
                        <td>{{ $room->status == 1 ? 'Aktív' : 'Inaktív' }}</td>
                        <td>{{ $room->number_of_employees }}</td>
                        <td>
                            <a href="{{ route('admin.update.room', ['id' => $room->id]) }}" class="text-primary" title="Szoba módosítása">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
