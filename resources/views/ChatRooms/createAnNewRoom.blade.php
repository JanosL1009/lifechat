@extends('layouts.app')
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
                
                    {{-- <input type="text" placeholder="Írj üzenetet..." name="sendmessage" id="sendmessage" /> --}}
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


