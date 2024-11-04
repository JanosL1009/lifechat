{{-- @extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-12 col-md-9">
        
        <div class="row">
            <div class="chat-messages">
                <p><span class="moderator">ModiUser-Moderator:</span> Szépen írjon mindenki</p>
                <p><span class="user1">User1:</span> Hello, mi van itt?</p>
                <p><span class="user2">User2:</span> Szia, hogy vagy??</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-10">
                
                     <input type="text" placeholder="Írj üzenetet..." name="sendmessage" id="sendmessage" /> 
                    <textarea name="sendmessage" id="sendmessage" class="form-control" ></textarea>
                   
                
            </div>
            <div class="col-12 col-md-2">
                <button id="msgSendBtn">Küldés</button>
            </div>
            
        </div>
               
           
           
       
    </div>

    <div class="col-12 col-md-3">
        <div class="user-list">
            <div class="user">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="User avatar" class="user-avatar">
                <div class="user-details">
                    <span class="user-name">User1</span>
                    <div class="user-icons">
                        <i class="fa fa-address-book"></i>
                        <i class="fas fa-video-camera"></i>
                        <i class="fas fa-comment"></i>
                    </div>
                </div>
            </div>           
            <div class="user">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="User avatar" class="user-avatar">
                <div class="user-details">
                    <span class="user-name">User1</span>
                    <div class="user-icons">
                        <i class="fa fa-address-book"></i>
                        <i class="fas fa-video-camera"></i>
                        <i class="fas fa-comment"></i>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



@endsection

 --}}

 @extends('layouts.app')
@section('content')
<style>
    .lifechatlogo
    {
        text-align: center;
    }
</style>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h1>Szoba létrehozása</h1>
                    </div>
                    <div class="lifechatlogo">
                        <img src="{{ asset('images/lifechat.gif') }}" alt="" style="width:300px; height:100px;">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.room.createnew.post')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 d-flex flex-column align-items-center">
                                            <div class="mt-3">
                                                <label for="roomImage" class="form-label">Szoba bélyegkép feltöltése</label>
                                                <input type="file" id="roompictures" name="roompictures" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column align-items-center">
                                            <div class="mt-3">
                                                <label for="chatImage" class="form-label">Chat háttérkép feltöltése</label>
                                                <input type="file" id="chatpictures" name="chatpictures" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="roomname">Szoba neve</label>
                                                <input type="text" id="roomname" name="roomname" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Szoba leírás</label>
                                                <input type="text" id="describe" name="describe" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Szoba állapota</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="1">Aktív</option>
                                                    <option value="2">Inaktív</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="maxnumber">Létszám</label>
                                                <input type="number" class="form-control" id="nmbofempl" name="nmbofempl" min="0">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Létrehozás</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
