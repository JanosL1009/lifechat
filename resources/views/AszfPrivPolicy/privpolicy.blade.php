
@extends('layouts.login')
@section('content')
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #C6FCFC !important;
    display: flex;
    justify-content: center;
    height: 100vh;
}
.logo
{
    width: 300px;
    height: auto;
}
</style>
<div class="container">
    <div class="row ">
           <div class="col-md-12">
                <div style="text-align: center;">
                    <img src="{{asset('images/lifechat.gif')}}" alt="Lifechat" class="logo">
                </div>
        
                <div class="pagetitle" style="text-align:center;">
                    <h1>{{$privpolicypage->name}}</h1>
                </div>
        
                <div class="content">
                    {!! $privpolicypage->content !!}
                </div>
                
           </div>
            
    </div>
</div>
@endsection
