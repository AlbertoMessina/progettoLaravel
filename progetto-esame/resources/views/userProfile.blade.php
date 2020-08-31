@extends('templates.layout')
@section('webSection' , 'Your Profile')
@section('css')
<link rel="stylesheet" href="{{asset('css/userProfile.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
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

   </div>

</div>
@stop

@section('script')
<script>
/*TEXT PER IL SIGN IN */
$("#loginContainer").hide();
/*TEXT PER IL SING IN*/
$(document).ready(function(){

});
</script>
@stop
