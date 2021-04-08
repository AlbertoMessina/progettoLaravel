@extends('templates.layout')
@section('webSection' , 'Edit Workout')
@section('home', '/dashboard')
@section('css')
<link rel="stylesheet" href="{{asset('css/scrollbar.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/components/table.css')}}">
<link rel="stylesheet" href="{{asset('css/editWorkout.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/genericModal.css')}}">
<!--Javascript import -->
<script src="{{asset('js/editWorkout.js')}}" defer></script>
@stop


@section('content')

<div class="section-content">

    <div id="workoutTable">
        <div>
            @foreach ($workout as $workout)
            <h6> {{$workout->name}} {{$workout->publication_date}}</h6>
            @endforeach
        </div>
        <div class="table-header">
            <div>
                NAME
            </div>
            <div>
                TYPE
            </div>
            <div>
                SERIES
            </div>
            <div>
                REP
            </div>
            <div>
                <a class="btn btn-secondary" id="addLink" role="button"><span class="fas fa-plus add-exercise"> </span></a>
            </div>

        </div>
        @foreach ($exercises as $exercise)
        <div>
            <p> {{$exercise->name}} {{$exercise->type}}</p>
        </div>

        @endforeach
    </div>
</div>
<!--Modal Alter-->
@include('/modalWindows/workoutModal/updateWorkout')
@endsection