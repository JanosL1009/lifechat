@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-12">
    <form action="{{ route('admin.szemely.kereses') }}" method="GET" class="mb-4">
      <div class="input-group">
          <input type="text" name="query" class="form-control" placeholder="Keresés email vagy felhasználónév alapján" value="{{ request('query') }}">
          <button type="submit" class="btn btn-primary">Keresés</button>
      </div>
    </form>
    
    @if(request('query') && $users->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Felhasználónév</th>
                    <th>Email</th>
                    <th>Profilkép</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ asset($user->profilepicture ? 'profilepicture/' . $user->profilepicture : 'profilepicture/default.jpg') }}" alt="Profile Picture" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                          <a href="{{ route('admin.szemely.szerkesztes', $user->id) }}" class="btn btn-sm btn-secondary">Szerkesztés</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(request('query'))
        <p>Nincs találat a keresési feltételeknek megfelelően.</p>
    @endif
  </div>
</div>

@endsection