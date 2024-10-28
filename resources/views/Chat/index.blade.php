@extends('layouts.app')
@section('content')
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #1e1e1e;
    color: white;
}

.chat-container {
    display: flex;
    height: 100vh;
}

.sidebar {
    width: 20%;
    background-color: #2e2e2e;
    padding: 10px;
}

.room {
    display: flex;
    align-items: center;
    background-color: #4C89CD;
    padding: 10px;
    /*margin-bottom: 10px;*/
    border-radius: 5px;
    color: white;
}

.room:hover {
    display: flex;
    align-items: center;
    background-color: #8a93a3;
    padding: 10px;
    /*margin-bottom: 10px;*/
    border-radius: 5px;
    color: white;
}

.room-icon {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.room-details {
    display: flex;
    flex-direction: column;
}

.room-name {
    font-weight: bold;
}
.room-count-icons {
    display: flex;
    align-items: center;
    margin-top: 5px; 
}
.room-count-icons i:hover {
    color: #2de62a; 
}
.room-count-icons i {
    color: white;
    margin-left: 10px; 
    cursor: pointer;
    font-size: 14px;
}
.room-count {
    margin-right: 10px;
}
.room-number {
    color: #D22326;
    font-weight: bold; 
}

.chat-box {
    width: 60%;
    display: flex;
    flex-direction: column;
    background-color: #101010;
    padding: 10px;
    position: relative;
}

.chat-header {
    background-color: #2e2e2e;
    padding: 10px;
    border-bottom: 1px solid #39414f;
    text-align: center;
    font-weight: bold;
}

.chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background-color: #000;
}

.chat-messages p {
    margin: 5px 0;
}

.moderator {
    color: red;
}

.user1 {
    color: yellow;
}

.user2 {
    color: lime;
}

.chat-input {
    display: flex;
    padding: 10px;
    border-top: 1px solid #39414f;
}

.chat-input input {
    flex: 1;
    padding: 10px;
    border: none;
    background-color: #2e2e2e;
    color: white;
    border-radius: 5px;
    margin-right: 10px;
}

.chat-input button {
    padding: 10px;
    border: none;
    background-color: #39414f;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.user-list {
    width: 20%;
    background-color: #2e2e2e;
    padding: 10px;
}

.user {
    display: flex;
    align-items: center;
    background-color: #39414f;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.user-avatar {
    width: 50px; 
    height: 50px;
    border-radius: 50%; 
    margin-right: 10px;
}

.user-name {
    color: white;
    font-weight: bold;
}
.user-icons {
    margin-top: 5px;
}

.user-icons i {
    color: white;
    margin-right: 10px;
    font-size: 14px; 
    cursor: pointer;
}

.user-icons i:hover {
    color: #00d1b2; 
}
.chat-header {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    background-color: #39414f;
    padding: 10px;
    border-bottom: 1px solid #555;
    color: white;
}
.chat-header:nth-child(2) {
    justify-content: center; 
}
.header-left i, .header-right i {
    font-size: 18px;
    color: white;
    margin-right: 15px; 
    cursor: pointer;
}

.header-left i:last-child {
    margin-right: 0; 
}

.header-right i {
    margin-left: 15px;
}

.header-right i:hover, .header-left i:hover {
    color: #D22326; 
}
.active-room-name {
    text-align: center;
    padding: 10px;
    background-color: #2e3b4e;
    color: white;
    font-size: 16px;
    border-bottom: 1px solid #555;
}
@media (min-width: 768px) {
        .chat-container {
            flex-direction: row; 
        }

        .sidebar {
            width: 20%; 
        }

        .chat-box {
            width: 60%; 
        }

        .user-list {
            width: 20%; 
        }
    }
</style>
<div class="col-12 col-md-12">
    <div class="chat-container">
             
        <div class="chat-box">
            
           
            <div class="chat-messages">
                <p><span class="moderator">ModiUser-Moderator:</span> Szépen írjon mindenki</p>
                <p><span class="user1">User1:</span> Hello, mi van itt?</p>
                <p><span class="user2">User2:</span> Szia, hogy vagy??</p>
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Írj üzenetet..." />
                <button>Küldés</button>
            </div>
        </div>
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