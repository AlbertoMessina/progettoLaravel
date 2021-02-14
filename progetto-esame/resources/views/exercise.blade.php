@extends('templates.layout')
@section('webSection' , 'Exercise')
@section('home', '/dashboard')
@section('css')
<link rel="stylesheet" href="{{asset('css/exercise.css')}}">
<link rel="stylesheet" href="{{asset('css/scrollbar.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
<link rel="stylesheet" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/filePreview.css')}}">
<link rel="stylesheet" href="{{asset('css/modal/genericModal.css')}}">
<!--Javascript import -->
<script src="{{asset('js/exercise.js')}}" defer></script>
<script src="{{asset('js/filePreview.js')}}" defer></script>
@stop

@section('content')
{{--Tabella esercizi--}}
<div class= "table-container  ">
   <ul class="list-group list-group-item light-border" id='exerciseTable'>
      <li class="list-group-item table-header">

            <div>
               NAME
            </div>
            <div>
               TYPE
            </div>
            <div>
               DIFFICULTY
            </div>
            <div>
            <a class="btn btn-secondary" id="addLink" data-toggle="tooltip" data-placement="left" title="Add new" role="button"><span class="fas fa-plus add-exercise"> </span></a>
            </div>

      </li>

      @foreach ($exercise as $exercise)
      <li class="list-group-item " id = 'li_{{$loop -> index}}' >
         <div class="container-internal">
            <div id ='li_{{$loop -> index}}_name'  class ="exercise-name"   data-id='{{$exercise->id}}' data-name = '{{$exercise->name}}'>
               {{$exercise->name}}
            </div>
            <div id ='li_{{$loop -> index}}_type' class ="exercise-type" data-type='{{$exercise->type}}'>
             {{$exercise->type}}
            </div>
            <div id ='li_{{$loop -> index}}_difficulty' class ="exercise-difficulty" data-difficulty='{{$exercise->difficulty}}'>
               {{$exercise->difficulty}}
            </div>
            <div  class ="button-container">

               <a class="btn  show " data-toggle="tooltip" data-placement="top" title="Show"  role = "button" data-li-reference ='li_{{$loop -> index}}'><i class='far fa-eye show-exercise icon-table'></i></a>
               @if($exercise->custom_id != 0)

                  <a class="btn  edit"   data-toggle="tooltip" data-placement="top" title="Edit" role="button" data-li-reference ='li_{{$loop -> index}}' ><i class='far fa-edit edit-execise icon-table'></i></a>
                  <a class="btn  delete" data-toggle="tooltip" data-placement="top" title="Delete" role="button" data-li-reference ='li_{{$loop -> index}}' ><i class='fas fa-trash trash-exercise icon-table'></i></a>

               @endif
            </div>
         </div>
      </li>
      @endforeach
   </ul>
</div>
<div id="snackbar" class="snackbar"><i></i><span>Operation snackbar</span></div>
<!--Modals-->

<!--Modal new exerise-->
@include('/modalWindows/exerciseModal/newExercise')
<!--End modal-->

<!--Modal Alter-->
@include('/modalWindows/exerciseModal/updateExercise')
<!--delete Modal-->
@include('/modalWindows/exerciseModal/deleteExercise')
<!--show -->
@include('/modalWindows/exerciseModal/showExercise')

@endsection


@section('script')

   <script>
   /*TEXT PER IL SIGN IN */
   $("#loginContainer").hide();
   /*TEXT PER IL SING IN*/
   
   $(document).ready(function(){

   });


</script>

@endsection
