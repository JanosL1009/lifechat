@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />


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
                        <a href="{{route('get.user.view',["userid" => 1])}}" target="_blank"><i class="fa fa-address-book"></i></a>
                        <i class="fas fa-video-camera"></i>
                        <a href="{{route('chat.privateRoom',['roomid' => 1])}}" target="_blank"><i class="fas fa-comment"></i></a>
                    </div>
                </div>
            </div>           
            <div class="user">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="User avatar" class="user-avatar">
                <div class="user-details">
                    <span class="user-name">User1</span>
                    <div class="user-icons">
                        <a href="{{route('get.user.view',["userid" => 1])}}" target="_blank"><i class="fa fa-address-book"></i></a>
                        <i class="fas fa-video-camera"></i>
                        <a href="{{route('chat.privateRoom',['roomid' => 1])}}" target="_blank"><i class="fas fa-comment"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>




<script>
const roomName = '{{$room->name}}';
document.getElementById('roomName').innerText = roomName;

document.getElementById('msgSendBtn').addEventListener('click', function() {
    // Az értékek beolvasása az űrlap mezőkből vagy más forrásokból
    const roomID = room_id;
    const message = document.getElementById('sendmessage').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Kérés küldése a szerverre
    fetch('{{route('setRoomMessage')}}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        // Az üzenet küldése paraméterekben
        body: JSON.stringify({
            room_id: roomID,
            msg: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alert("Üzenet sikeresen elküldve!");
        } else {
            alert("Hiba történt: " + data.error);
        }
    })
    .catch(error => {
        console.error("Hálózati hiba:", error);
    });
});



</script>


<script>
 
</script>

@endsection

<!--
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
        }
    }
</script>
  <script type="module">
    import {
        ClassicEditor,
            Essentials,
            Bold,
            Italic,
            FontSize,
            FontFamily,
            FontColor,
            FontBackgroundColor,
            Paragraph,
            Link,
            List,
            Heading, SourceEditing
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#sendmessage'), {
            plugins: [   Essentials, Bold, Italic, FontSize, FontFamily, 
            FontColor, FontBackgroundColor, Paragraph, Link, List, Heading, SourceEditing],
            toolbar: {
                items: [
                    'undo', 'redo', '|',  'heading', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'link', 'bulletedList', 'numberedList', '|', 'sourceEditing'
                ]
            },
            heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },
            fontSize: {
                options: [
                    'tiny',
                    'small',
                    'default',
                    'big',
                    'huge'
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ]
            }


        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script> - -->