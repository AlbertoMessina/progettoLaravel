@extends('templates.layout')
@section('title' , $title )

@section('content')
<div class = "title bg-dark text-white">
<h1>
   {{$title}} + blade
</h1>
</div>

@if($staff)
<div>
   <ul>
      <!-- foreach ha  una variabile utile chiamta loop -->

      @foreach($staff as $person)
      <!-- esempui di uso di loop -->
      <li style="{{$loop->first ?'color:red' : ' '}}"> {{$loop->first}} {{$person['name']}} {{$person['lastname']}}</li>

      @endforeach
   </ul>
</div>
   @else
   <div>
      <p>No struff</p>
   </div>
@endif

<!-- costrutti forelese-->
<!-- Questo costrutto è buono perchè permette di evitare di scrivere if /else per condizioni semplici
<ul>
@forelse($staff as $person)

   <li> {{$person['name']}} {{$person['lastname']}}</li>
   @empty
   <li> No staff </li>
@endforelse
</ul>
-->
@stop
