@extends('layouts.app')

@section('content')
<style>
    .card-header {
        text-align: center;
    }
    .user-list {
        border: 1px solid #dee2e6;
        padding: 10px;
        border-radius: 5px;
        height: 300px; 
        overflow-y: auto;
    }
    .selected-user {
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Elérhető operátorok</h3>
                </div>
                <div class="card-body user-list">
                    <ul class="list-group" id="available-users">
                        @foreach ($availableUsers as $user)
                            <li class="list-group-item selected-user" data-username="{{ $user->username }}" data-email="{{ $user->email }}" data-userid="{{ $user->id }}">
                                {{ $user->username }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="card">
                <div class="card-header">
                    <h3>Hozzáadott operátor</h3>
                </div>
                <div class="card-body user-list">
                    <ul class="list-group" id="added-users">
                        @foreach ($addedUsers as $addedUser)
                            <li class="list-group-item added-user" data-userid="{{ $addedUser->user_id }}">
                                {{ $addedUser->user->username }}
                                <button class="btn btn-danger btn-sm float-end remove-user" data-userid="{{ $addedUser->user_id }}">X</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const roomId = {{ $room_id }};

        $('#available-users').on('click', '.selected-user', function () {
            const username = $(this).data('username');
            const userId = $(this).data('userid');

            const newListItem = $('<li class="list-group-item"></li>').text(username)
                .append('<button class="btn btn-danger btn-sm float-end remove-user" data-userid="'+userId+'">X</button>');
            $('#added-users').append(newListItem);

            $(this).remove();

            $.ajax({
                url: '{{ route("admin.operators.create.post") }}', 
                method: 'POST',
                data: {
                    user_id: userId,
                    room_id: roomId,
                    _token: '{{ csrf_token() }}' 
                },
                success: function (response) {
                    console.log('Felhasználó sikeresen hozzáadva:', response);
                },
                error: function (xhr) {
                    console.error('Hiba a felhasználó hozzáadásakor:', xhr.responseText);
                }
            });
        });

        $('#added-users').on('click', '.remove-user', function () {
            const userId = $(this).data('userid');
            const username = $(this).parent().contents().filter(function() {
                return this.nodeType === Node.TEXT_NODE; 
            }).text().trim(); 

            const newListItem = $('<li class="list-group-item selected-user"></li>')
                .data('username', username)
                .data('userid', userId)
                .text(username);

            $('#available-users').append(newListItem);

            $(this).parent().remove();

            $.ajax({
                url: '{{ route("admin.operators.remove.post") }}', 
                method: 'POST',
                data: {
                    user_id: userId,
                    room_id: roomId,
                    _token: '{{ csrf_token() }}' 
                },
                success: function (response) {
                    console.log('Felhasználó sikeresen eltávolítva:', response);
                },
                error: function (xhr) {
                    console.error('Hiba a felhasználó eltávolításakor:', xhr.responseText);
                }
            });
        });
    });
</script>



@endsection
