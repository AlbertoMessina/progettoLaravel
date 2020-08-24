@extends('templates.layout')
@section('webSection' , 'Exercise')
@section('home', '/dashboard')
@section('css')
<link rel="stylesheet" href="{{asset('css/exercise.css')}}">
<link rel="stylesheet" href="{{asset('css/scrollbar.css')}}">
<link rel="stylesheet" href="{{asset('css/snackbar.css')}}">
@stop
@section('logButton')
<div id="logout-container" class="log-containers">
   <button class="btn btn-danger "><label class="hide-meta  text-size-small pr-2">Log Out</label><span class="fas fa-sign-out-alt"></span></button>
</div>
@stop
@section('content')
{{--Tabella esercizi--}}
<div class= "table-container  ">
<ul class="list-group list-group-item light-border" id='exerciseTable'>
   <li class="list-group-item table-header">
      <div class="header-container" style="background-color: lightgrey">
         <div class ="width-25">
            NAME
         </div>
         <div class ="width-25">
            DIFFICULTY
         </div>
         <div  class ="width-25 d-flex justify-content-end">
         <a class="btn btn-secondary mr-2 " id="addLink" href="#exerciseModal"   data-toggle="tooltip" data-placement="left" title="Add new" role="button" role = "button" ><span class="fas fa-plus add-exercise"> </span></a>
         </div>
   </div>
   </li>

   @foreach ($exercise as $exercise)
   <li class="list-group-item ">
      <div class="container_internal">
         <div class ="width-25 exercise-name"   data-url='{{$exercise->img_path}}' data-id='{{$exercise->id}}' data-name = '{{$exercise->name}}'>
            {{$exercise->name}}
         </div>
         <div class ="width-25 exercise-difficulty" data-difficulty = '{{$exercise->difficulty}}'>
            {{$exercise->difficulty}}
         </div>
         <div  class ="width-25 button-container">

            <a class="btn  show " data-toggle="tooltip" data-placement="top" title="Show"  role = "button"><i class='far fa-eye show-exercise icon-table'></i></a>
            @if($exercise->custom_id != 0)

               <a class="btn  edit"   data-toggle="tooltip" data-placement="top" title="Edit" role"button"><i class='far fa-edit edit-execise icon-table'></i></a>
               <a class="btn  delete" data-toggle="tooltip" data-placement="top" title="Delete" role="button" ><i class='fas fa-trash trash-exercise icon-table'></i></a>

            @endif
         </div>
   </div>
   </li>
   @endforeach
</ul>
<div class="snackbar"><i></i><span>Operation snackbar</span></div>
{{--Modals--}}

{{--Modal new exerise--}}
@include('/modalWindows/exerciseModal/newExercise')
{{--End modal--}}

{{--Modal Alter--}}
@include('/modalWindows/exerciseModal/updateExercise')
{{--delete Modal--}}
@include('/modalWindows/exerciseModal/deleteExercise')
{{--show --}}
@include('/modalWindows/exerciseModal/showExercise')
@endsection

@section('script')

<script>
/*TEXT PER IL SIGN IN */
$("#loginContainer").hide();
/*TEXT PER IL SING IN*/
$(document).ready(function(){

   //apertura modale
  $('#addLink').click(function(){
    $('#exerciseModal').modal();
  });
 //record creation
  $('#exercise_create').click(function(){
     event.preventDefault();
   var name = $('#exercise-name').val();
   var difficulty = $('#exercise-difficulty').val();
   var info = $('#exercise-info').val();
   if(info == null || info == ''){

         info ="No description";

   }
   //ajax call input
 if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0){
      jQuery.ajax({
         url:'{{route('exercise.save')}}',
         type:"POST",
         data:{
            "_token": "{{csrf_token()}}",
            name: name,
            description: info,
            difficulty: difficulty,
         },
         success:function(data){
            //insert
            let id = data.insertedId;
            // Ho l'id della roba inserita
            //add elem to table
            let newIl = '<li class="list-group-item ">' +
               '<div class="container_internal">'+
                  '<div  class ="width-25 exercise-name"  data-id='+id+ ' data-name = '+name+'>'+
                      name +
                  '</div>' +
                  '<div class ="width-25 exercise-difficulty  data-difficulty = '+ difficulty+ '" >' +
                      difficulty +
                  '</div>' +
                  '<div  class ="width-25  button-container">' +

                  '<a class="btn  show" data-toggle="tooltip" data-placement="top" title="Show"  role = "button">' +
                  '<i class="far fa-eye show-exercise icon-table">' +
                  '</i>' + '</a>' +
                  '<a class="btn  edit" data-toggle="tooltip" data-placement="top" title="Edit" role"button">' +
                   '<i class="far fa-edit edit-execise icon-table">'+
                   '</i>' + '</a>' +
                  '<a class="btn  delete" data-toggle="tooltip" data-placement="top" title="Delete" role="button" >' +
                  '<i class="fas fa-trash trash-exercise icon-table">' +
                  '</i>' + '</a>'

                   +'</div>'+
            '</div >'+
            '</li>';
            $("#exerciseTable li:first-child").after(newIl);
            $("[data-toggle='tooltip']").tooltip();
            $("#exerciseModal").modal('toggle');
            operationSuccessShow();
            //append del child

         },
      });
   }else{
      alert('Fill filed properly');
   }
  });
//modal update
$('ul').on('click', '.edit', function(ele){
   var id = $(this).closest('li').find('.exercise-name').data('id');
   var li = $(this).closest('li');
      //chiamata ajax per prendere i valori
   jQuery.ajax({
      url:'{{route('exercise.getRecord')}}',
      type:"GET",
      data:{
         "_token": "{{csrf_token()}}",
         id: id,
      },
      success:function(data){
      console.log(data);
      var name = data.exercise[0].name;
      var difficulty = data.exercise[0].difficulty;
      var info = data.exercise[0].description;
      //$('#alterExerciseForm').data('id' , id);

      $('#update-name').val(name);
      $('#update-difficulty').val( difficulty);
      $('#update-info').val( info);
      $('#liTarget').data('li', li);
      $('#updateId').data('id', id);
      },
      error:function(){
         alert("Please reload page, noob programmer");
         $('#exercise_update_modal').modal('toggle');
      },
   });
   setTimeout(function(){ $('#exercise_update_modal').modal(); }, 200);
});
//ExerciseUpdate
$('#exercise_update').on('click', function(ele){
   //get value from input
   let name = $('#update-name').val();
   let difficulty = $('#update-difficulty').val();
   let info = $('#update-info').val();
   let file = $('#update-image')[0].files[0];

   /*Form data
   let fd = new FormData();
   let toke = $('meta[name="csrf-token"]').attr('content')
   alert( toke);
   fd.append('name' , name);
   fd.append('file', file);
   fd.append('difficulty', difficulty);
   fd.append('info', info);
    */
   if(info == null || info == ''){
         info ="No description";
   }
   if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0 ){
   //get id for ajax call
   var id = $('#updateId').data('id');

   jQuery.ajax({
      url:'{{route('exercise.updateExercise')}}',
      method:"post",
      data:{
            "_token": "{{csrf_token()}}",
            id: id,
            name: name,
            difficulty: difficulty,
            info:info,
      },
      cache: false,

      success:function(data){
         var li = $('#liTarget').data('li');
         //set new value input
         li.find('.exercise-name').html(name);
         li.find('.exercise-difficulty').html(difficulty);
         // modal close
         $('#exercise_update_modal').modal('toggle');
         //add class for show snackbar
         operationSuccessShow();

      },
      error:function(){
         operationFailedShow();


      },
   });
}else{
   alert('Fill filed properly');
};
});

//modal delete

$('ul').on('click', '.delete', function(ele){
   var id = $(this).closest('li').find('.exercise-name').data('id');
   var li = $(this).closest('li');
   $('#exercise_modal_delete').modal()
   $('#deletedId').data('id' , id);
   $('#deleteli').data('li' , li);
});
//record delete
$('#exercise_delete').on('click', function(ele){

   var id = $('#deletedId').data('id');
   //ajax call
  jQuery.ajax({
      url:'{{route('exercise.delete')}}',
      type:"DELETE",
      data:{
         "_token": "{{csrf_token()}}",
         id: id,
      },
      success:function(data){

         var li =$('#deleteli').data('li');
         li.remove();
         $('#exercise_modal_delete').modal('toggle');
         operationSuccessShow();
      },
      error:function(){
         operationFailedShow();

      },
   });

});

//end record delete

$('ul').on('click', '.show', function(ele){
   var id = $(this).closest('li').find('.exercise-name').data('id');
   jQuery.ajax({
      url:'{{route('exercise.getRecord')}}',
      type:"GET",
      data:{
         "_token": "{{csrf_token()}}",
         id: id,
      },
      success:function(data){;
      let name = data.exercise[0].name;
      let info = data.exercise[0].description;
      let url = data.exercise[0].img_path;
      //$('#alterExerciseForm').data('id' , id);
      if(url == "none"){
         url ="/images/defaultImage.jpg";
      }
      $('#imgExercise').attr("src", url);
      $('#show-name').html(name);
      $('#show-info').html(info);
      },
      error:function(){
         alert("Please reload page, noob programmer");
         $('#exercise_show_modal').modal('toggle');
      },
   });
   setTimeout(function(){$("#exercise_show_modal").modal(); }, 600);

});

});

function operationSuccessShow(){
      let snackbar = $('.snackbar');
      snackbar.addClass("operationSuccess");
      $('.snackbar i').addClass('fas fa-check mr-1');
      $('.snackbar span').text('Operation Success')
      setTimeout(function(){snackbar.removeClass("operationSuccess")}, 2500);
}

function operationFailedShow(){
      let snackbar = $('.snackbar');
      snackbar.addClass("operationFailed");
      $('.snackbar i').addClass('fas fa-exclamation-triangle mr-1');
      $('.snackbar span').text('Operation Failed');
      setTimeout(function(){snackbar.removeClass("operationFailed")}, 2500);
}
</script>

@endsection
