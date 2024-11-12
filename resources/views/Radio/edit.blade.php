
@extends('layouts.app')
@section('content')
<style>
    .lifechatlogo
    {
        text-align: center;
    }
    .card-header{
        text-align: center;
    }
</style>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h1>Rádió szerkesztése</h1>
                    </div>
                    <div class="lifechatlogo">
                        <img src="{{ asset('images/lifechat.gif') }}" alt="" style="width:300px; height:100px;">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.radio.edit.post')}}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id" value="{{$radio->id}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="radioname">Rádió neve</label>
                                                <input type="text" id="radioname" name="radioname" class="form-control" value="{{$radio->radioName}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="radioname">Státusz</label>
                                                <label for="status">Szoba állapota</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="1" {{ $radio->radioStatus == '1' ? 'selected' : '' }}>Aktív</option>
                                                    <option value="2" {{ $radio->radioStatus == '2' ? 'selected' : '' }}>Inaktív</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="radiolink">Rádió linkje</label>
                                                <input type="text" class="form-control" id="radiolink" name="radiolink" value="{{$radio->radioURL}}">
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mt-3">Mentés</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const roomName = '{{$radio->radioName}}';
    document.getElementById('roomName').innerText = roomName;
</script>
@endsection
