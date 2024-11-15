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
            @if(session('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
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
                        <td><a href="#" id="{{ $room->id }}" class="chatRoomLink" onclick="EnteringTheRoom({{ $room->id }})">{{ $room->name }}</a></td>
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
<!-- 
<script>
    const userid = {{ \Auth::id() }}; 
    
    async function EnteringTheRoom(room_id) {
        const url = "{{ route('enteringChatRoom.post') }}";
        
        try {
            // Fetch kérés küldése a szerverre
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token a biztonság érdekében
                },
                body: JSON.stringify({
                    userid: userid,
                    room_id: room_id
                })
            });
    
            const result = await response.json();
    
            if (response.ok && result.result === 1) {
                
                alert('Sikeresen beléptél a szobába!');
                // További logika itt (pl. átirányítás a chat szobára)
            } else {
                alert('Már be vagy lépve ebbe a szobába! ');
            }
        } catch (error) {
            console.error('Hiba történt a kérés során:', error);
            alert('Valami hiba történt, próbáld újra később.');
        }
    }
    </script>



-->    @endsection
