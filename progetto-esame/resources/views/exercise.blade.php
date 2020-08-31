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

         <div class ="width-25">
            NAME
         </div>
         <div class ="width-25">
            DIFFICULTY
         </div>
         <div  class ="width-25 d-flex justify-content-end">
         <a class="btn btn-secondary mr-2 " id="addLink" href="#exerciseModal"   data-toggle="tooltip" data-placement="left" title="Add new" role="button" role = "button" ><span class="fas fa-plus add-exercise"> </span></a>
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
<script src="{{asset('js/snackbar.js')}}"> </script>
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
  $('#exerciseForm').submit(function(ele){

   ele.preventDefault();
   let name = $('#exercise-name').val();
   let difficulty = $('#exercise-difficulty').val();
   let info = $('#exercise-info').val();

   //form data
   let form = document.getElementById('exerciseForm');
   let fd = new FormData(form);
   if(info == null || info == ''){

         info ="No description";

   }

 if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0){
    $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
    });
      jQuery.ajax({
         url:'{{route('exercise.save')}}',
         type:"POST",
         data: fd,
         contentType: false,
         processData: false,
         cache: false,
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
   $.ajaxSetup({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
   jQuery.ajax({
      url:'{{route('exercise.getRecord')}}',
      type:"GET",
      data:{
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
//WORKPOINT
//ExerciseUpdate
$('#updateExerciseForm').on('submit', function(ele){
   ele.preventDefault();
   //get value from input
   let name = $('#update-name').val();
   let info = $('#update-info').val();
   let difficulty= $('#update-difficulty').val();
   if(info == null || info == ''){
         info ="No description";
   }
   if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0 ){
   //get id for ajax call
   var id = $('#updateId').data('id');
   let form = document.getElementById('updateExerciseForm');
   let fd = new FormData(form);
   fd.append('update_id',id);
   $.ajaxSetup({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
   jQuery.ajax({
      url:'{{route('exercise.updateExercise')}}',
      method:"POST",
      data:fd,
      contentType: false,
      processData: false,
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
         // modal close
         $('#exercise_update_modal').modal('toggle');

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
   $.ajaxSetup({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
  jQuery.ajax({
      url:'exercise/delete/'+ id,
      type:"DELETE",
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

// SHOW MODAL
$('ul').on('click', '.show', function(ele){
   var id = $(this).closest('li').find('.exercise-name').data('id');
   $.ajaxSetup({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
   jQuery.ajax({
      url:'{{route('exercise.getRecord')}}',
      type:"GET",
      data:{
         id: id,
      },
      success:function(data){

      let exercise = data.exercise[0]
      let name = exercise.name;
      let info = exercise.description;
      let url = exercise.img_path;
      if((url.search('http')) === -1){
         url = 'storage/'+ url;
      }
      if(url.search('none') !== -1 ){
         url ="storage/images/default.png";
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


</script>

@endsection
