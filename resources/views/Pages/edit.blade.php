@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h1>{{$pages->name}}</h1>
                </div>
                <div class="card-body">
                   <div class="col-md-6">
                    <form action="{{route('admin.pages.edit.post',$pages->id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{$pages->id}}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Leírás</label>
                            <textarea name="content" id="content" class="form-control" cols="50" rows="30">{{$pages->content}}</textarea>                        
                        </div>
                        <button type="submit" class="btn btn-primary">Mentés</button>
                    </form>
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
        .create(document.querySelector('#content'), {
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