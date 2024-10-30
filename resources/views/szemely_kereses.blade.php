@extends('layouts.app')
@section('content')
<style>
  .searchuserimg{
    text-align:center;
  }
</style>
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
                    <th style="text-align:center;">Felhasználónév</th>
                    <th style="text-align:center;">Email</th>
                    <th style="text-align:center;">Profilkép</th>
                    <th style="text-align:center;">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="text-align:center;">{{ $user->username }}</td>
                        <td style="text-align:center;">{{ $user->email }}</td>
                        <td class="searchuserimg">
                            <img src="{{ asset($user->profilepicture ? 'profilepicture/' . $user->profilepicture : 'profilepicture/default.jpg') }}" alt="Profile Picture" style="width: 50px; height: 50px;" class="searchuserimg">
                        </td>
                        <td style="text-align:center;">
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