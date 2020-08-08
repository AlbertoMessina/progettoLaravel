@extends('templates.layout')
@section('webSection' , 'Your Profile')
@section('content')
<div style = "height: calc(100vh - 160px)">
   <div class=" profileInfo" >
      <div class="userPhoto" >
         <img class="p-3" src="/images/unknow.jpg"> </img>
      </div>
      <div class="userInfo" >
         <label class="p-5">Some fucnin test </label>
      </div>
   </div>
   <div class=" classProfile">
      <h1>Daily class workout </h1>
      <label>Qua vanno le miniature delle classi per cui si ha un allemaneto gioranta </label>
   </div>
</div>
@stop
