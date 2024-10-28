@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />

<style>
    #editor-container {
        resize: both;
        overflow: auto;
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        min-height: 20px;
        max-height: 10px;
    }
    .ck-editor__editable {
        min-height: 100px;
    }

    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #1e1e1e;
    color: rgb(255, 255, 255);
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
        color: #ffdf0d; 
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
    color: black;
    }

    .chat-input textarea {
        flex: 1;
        padding: 10px;
        border: none;
        background-color: #2e2e2e;
        color: rgb(0, 0, 0);
        border-radius: 5px;
        margin-right: 10px;
        width: 70%; /* Változtasd meg a kívánt szélességre */
        max-width: 400px; /* Maximális szélesség, ha szeretnéd */
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
                {{-- <input type="text" placeholder="Írj üzenetet..." name="sendmessage" id="sendmessage" /> --}}
                <textarea name="sendmessage" id="sendmessage" class="form-control" cols="10" rows="10"></textarea>
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
</script>
