@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="lifechatlogo">
            <img src="{{ asset('images/lifechat.gif') }}" alt="">
        </div>      
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 style="text-align:center;">Szobák</h1> 
                <div>
                    <a href="{{ route('admin.NewRoom') }}" class="btn btn-primary">Létrehozás</a> 
                </div>
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
                            <a href="{{route('admin.operators.add', ['room_id' => $room->id])}}"><i class="fa fa-user-secret" aria-hidden="true"></i>
                            </a>
                            
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
