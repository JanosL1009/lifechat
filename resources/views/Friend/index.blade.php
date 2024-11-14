@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 style="text-align:center;">Barátok</h1> 
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFriendModal">
                        Új barát hozzáadása
                    </button>
                    <button type="button" class="btn btn-secondary position-relative" data-bs-toggle="modal" data-bs-target="#friendRequestsModal">
                        Barátfelkérések
                        <span id="friendRequestsCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        </span>
                    </button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Név</th>
                    <th>Email cím</th>
                    <th>Profilkép</th>
                    <th>Műveletek</th>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>            
        </div>
    </div>
</div>

<div class="modal fade" id="addFriendModal" tabindex="-1" aria-labelledby="addFriendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFriendModalLabel">Barát hozzáadása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
            </div>
            <div class="modal-body">
                <form id="addFriendForm">
                    @csrf
                    <div class="mb-3">
                        <label for="friendIdentifier" class="form-label">Felhasználónév vagy Email cím</label>
                        <input type="text" class="form-control" id="friendIdentifier" name="friend_identifier" placeholder="Felhasználónév vagy Email cím" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Barát hozzáadása</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="friendRequestsModal" tabindex="-1" aria-labelledby="friendRequestsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendRequestsModalLabel">Barátfelkérések</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
            </div>
            <div class="modal-body">
                <ul id="friendRequestsList" class="list-group">
                    <!-- Barátfelkérések dinamikus betöltése ide -->
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateFriendRequestsCount();
    
        document.getElementById('addFriendForm').addEventListener('submit', function (e) {
            e.preventDefault();
    
            let friendIdentifier = document.getElementById('friendIdentifier').value;
            let csrfToken = document.querySelector('input[name="_token"]').value;
    
            fetch("{{ route('friend.request') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ friend_identifier: friendIdentifier })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Barát kérés elküldve!');
                    document.getElementById('addFriendForm').reset();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('addFriendModal'));
                    modal.hide();
                    updateFriendRequestsCount(); 
                } else {
                    alert(data.message || 'Hiba történt!');
                }
            })
            .catch(error => console.error('Hiba:', error));
        });
    
        const friendRequestsModal = document.getElementById('friendRequestsModal');
        friendRequestsModal.addEventListener('show.bs.modal', function () {
            fetch("{{ route('friend.requests') }}")
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('friendRequestsList');
                    list.innerHTML = ''; 
    
                    if (data.requests && data.requests.length > 0) {
                        data.requests.forEach(request => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                            listItem.innerHTML = `
                                <span>${request.name} (${request.email})</span>
                                <div>
                                    <button class="btn btn-success btn-sm" onclick="acceptRequest(${request.id})">Elfogadás</button>
                                    <button class="btn btn-danger btn-sm" onclick="rejectRequest(${request.id})">Elutasítás</button>
                                </div>
                            `;
                            list.appendChild(listItem);
                        });
                    } else {
                        list.innerHTML = '<li class="list-group-item">Nincsenek beérkező barátfelkérések</li>';
                    }
                })
                .catch(error => console.error('Hiba történt a barátfelkérések betöltésekor:', error));
        });
    });
    
    function updateFriendRequestsCount() {
        fetch("{{ route('friend.requests.count') }}")
            .then(response => response.json())
            .then(data => {
                const countSpan = document.getElementById('friendRequestsCount');
                countSpan.innerText = data.count;
                countSpan.style.display = data.count > 0 ? 'inline' : 'none';
            })
            .catch(error => console.error('Hiba történt a számláló frissítésekor:', error));
    }
    
    function acceptRequest(id) {
        fetch(`{{ url('/friend/request/accept') }}/${id}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(() => {
                location.reload();
                updateFriendRequestsCount(); 
            });
    }
    
    function rejectRequest(id) {
        fetch(`{{ url('/friend/request/reject') }}/${id}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
            .then(() => {
                location.reload();
                updateFriendRequestsCount(); 
            });
    }
    </script>
    
@endsection
