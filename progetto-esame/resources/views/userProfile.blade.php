@extends('templates.layout')
@section('webSection' , 'Your Profile')
@section('css')
<link rel="stylesheet" href="{{asset('css/userProfile.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/genericModal.css')}}">
<script src="{{asset('js/userProfile.js')}}" defer></script>
@stop
@section('logButton')
<div id="logout-container" class="log-containers">
   <button class="btn btn-danger "><label class="hide-meta  text-size-small pr-2">Log Out</label><span class="fas fa-sign-out-alt"></span></button>
</div>
@stop
@section('content')
<div class="user-profile">
   <div class="profile-info" >
      <div id="user-photo-container" >
         <img id="user-photo" class="img-thumbnail img-fluid" src="/images/unknow.jpg"> </img>
      </div>
      <!-- Trigger/Open The Modal -->
      <button id="myBtn">Open Modal</button>
      <button id="myBtn2">Open Modal2</button>
   </div>
   @include('/modalWindows/exampleModal')
   @include('/modalWindows/exampleModal2')
</div>


@stop

@section('script')

@stop
