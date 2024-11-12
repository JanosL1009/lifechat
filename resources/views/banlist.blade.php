@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="lifechatlogo">
            <img src="{{ asset('images/lifechat.gif') }}" alt="">
        </div>      
        <div class="row">
            <div class="d-flex justify-content-center mb-3">
                <h1 style="text-align:center;">Bannolt személyek</h1> 
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
                        <th>Felhasználó neve</th>
                        <th>Szoba neve</th>
                        <th>Ban ideje</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banlist as $banl)
                    <tr>
                        <td>{{$banl->user->username }}</td>
                        <td>{{$banl->room->name}}</td>
                        <td>{{$banl->banmode->ban_name}}</td>
                        <td>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-valesid="{{$banl->id}}">
                                <i class="fa-solid fa-unlock deltool" data-toggle="tooltip" title="Törlés" data-valesid="{{$banl->id}}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $banlist->links() }}
            </div>
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Törlés</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Biztosan törölni szeretnéd?</p>
                            <p style="color: #ff0000;">A törlés gomb megnyomása után végleg törlődik az adatbázisból!</p>
                        </div>
                        <div class="modal-footer">
                            <input type="number" class="d-none" id="banid" name="banid" value="-1">
                            <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Mégse">
                            <input type="button" id="esemenyTorlesBtn" class="btn btn-danger" value="Törlés">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function () {
    let deleteModal = new bootstrap.Modal(document.getElementById('deleteEmployeeModal'));
   
    document.querySelectorAll('.delete').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.valesid; 
            document.getElementById('banid').value = id;

            deleteModal.show(); 
        });
    });

    document.getElementById('esemenyTorlesBtn').addEventListener('click', function () {
        let ban_id = document.getElementById('banid').value; 
        fetch('{{ url('admin/unban/post') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ banid: ban_id }) 
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(text); 
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); 
            } else {
                alert('Hiba történt a törlés során: ' + (data.message || 'Ismeretlen hiba')); 
            }
        })
        .catch(error => {
            console.error('Hiba történt:', error);
            alert('Hiba történt a törlés során: ' + error.message);
        });
    });
});

    </script>
    
@endsection
