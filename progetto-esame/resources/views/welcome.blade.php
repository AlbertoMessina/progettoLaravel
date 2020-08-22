@extends('templates.layout')
@section('user' , '')
@section('webSection' , '')
@section('arrow','')
@section('logButton')
<div id="login-container" class="log-containers">
   <button class="btn btn-success  "><label class="hide-meta text-size-small pr-2">Sign In</label><span class="fas fa-sign-in-alt"></span></button>
</div>
@stop
@section('script')
<script>
//fare hide quando avrò il content e potrò fare il login
//$(".side").hide();
//$(".main").css("flex", "100%");
$("#logoutContainer").hide();
//try t add width
</script>
@stop
