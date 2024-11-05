
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
                        <h1>Címke szerkesztése</h1>
                    </div>
                    <div class="lifechatlogo">
                        <img src="{{ asset('images/lifechat.gif') }}" alt="" style="width:300px; height:100px;">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.tags.edit.post')}}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="id" name="id" value="{{$tag->id}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tagname">Címke neve</label>
                                                <input type="text" id="tagname" name="tagname" class="form-control" value="{{$tag->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="choosecolor">Címke színe</label>
                                                <input type="color" class="form-control form-control-color" id="color" name="color" title="Choose your color" value="{{$tag->color}}">
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
    const roomName = '{{$tag->name}}';
    document.getElementById('roomName').innerText = roomName;
</script>
@endsection
