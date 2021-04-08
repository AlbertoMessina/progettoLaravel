@extends('templates.layout')
@section('webSection' , 'Workout')
@section('home', '/dashboard')
@section('css')
<link rel="stylesheet" href="{{asset('css/scrollbar.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/components/table.css')}}">
<link rel="stylesheet" href="{{asset('css/workout.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/genericModal.css')}}">
<!--Javascript import -->
<script src="{{asset('js/workout.js')}}" defer></script>

@stop


@section('content')
{{--Tabella esercizi--}}
<div class="table-container  ">
   <div class="table-header">
      <div>
         NAME
      </div>
      <div>
        DATE
      </div>
      <div>
         <a class="btn btn-secondary" id="addLink" role="button"><span class="fas fa-plus add-workout"> </span></a>
      </div>

   </div>
   <ul class="table-body" id='workoutTable'>

      @foreach ($workouts as $workout)
      <li id='li_{{$loop -> index}}'>
         <div class="table-item">
            <div id='li_{{$loop -> index}}_name' class="workout-name" data-id='{{$workout->id}}' data-name='{{$workout->name}}'>
               {{$workout->name}}
            </div>
            <div id='li_{{$loop -> index}}_date' class="workout-dated" data-pubblication=' {{$workout->publication_date}}'>
               {{$workout->publication_date}}
            </div>
            <div class="button-container">
               <a class="btn  show " role="button" data-li-reference='li_{{$loop -> index}}'><i class='far fa-eye show-workout icon-table' ></i></a>
               <a class="btn  edit" data-li-reference='li_{{$loop -> index}}' role="button"><i class='far fa-edit edit-workout icon-table'></i></a>
               <a class="btn  delete" role="button" data-li-reference='li_{{$loop -> index}}'><i class='fas fa-trash trash-workout icon-table'></i></a>
            </div>
         </div>
      </li>
      @endforeach
   </ul>
</div>
<div id="snackbar" class="snackbar"><i></i><span>Operation snackbar</span></div>
<!--Modals-->

<!--Modal new exerise-->
@include('modalWindows\workoutModal\newWorkout')
<!--End modal-->


<!--delete Modal-->
@include('/modalWindows/workoutModal/deleteWorkout')
<!--show -->
@include('/modalWindows/exerciseModal/showExercise')

@endsection
