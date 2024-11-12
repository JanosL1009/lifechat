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
                        <h1>Rádió hozzáadása</h1>
                    </div>
                    <div class="lifechatlogo">
                        <img src="{{ asset('images/lifechat.gif') }}" alt="" style="width:300px; height:100px;">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.radio.create.post')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="radioname">Rádió neve</label>
                                                <input type="text" id="radioname" name="radioname" class="form-control">
                                                @error('radioname')
                                                    <div class="text-danger">A mező kitöltése kötelező!</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Szoba állapota</label>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="1">Aktív</option>
                                                    <option value="2">Inaktív</option>
                                                </select>
                                                @error('status')
                                                <div class="text-danger">A mező kitöltése kötelező!</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="radiolink">Rádió linkje</label>
                                                <input type="text" class="form-control" id="radiolink" name="radiolink">
                                            </div>
                                            @error('radiolink')
                                            <div class="text-danger">A mező kitöltése kötelező!</div>
                                        @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Hozzáadás</button>
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
