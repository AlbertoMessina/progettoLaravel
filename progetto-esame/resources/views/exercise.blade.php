@extends('templates.layout')

@section('content')
{{--Tabella esercizi--}}
<div class= "ul-container">
   <li class="list-group-item table-header ">
      <div class="header-container" style="background-color: lightgrey">
         <div class ="width-25">
            Nome
         </div>
         <div class ="width-25">
            Difficulty
         </div>
         <div class ="width-25">
            Customid
         </div>
         <div  class ="width-25 d-flex justify-content-end">
         <a class="btn btn-secondary mr-2 " id="addLink" href="#exerciseModal" role = "button" >Add custom</a>
         </div>
   </div >
   </li>
   <ul class="list-group list-group-item ul-border" id='ulTable'>
   @foreach ($exercise as $exercise)
   <li class="list-group-item list-group-item-border-li">
      <div class="container_internal">
         <div class ="width-25 exercise-name"  data-id='{{$exercise->id}}' data-name = '{{$exercise->name}}'>
            {{$exercise->name}}
         </div>
         <div class ="width-25 exercise-difficulty" data-difficulty = '{{$exercise->difficulty}}'>
            {{$exercise->difficulty}}
         </div>
         <div class ="width-25 exercise-custom">
            {{$exercise->custom_id}}
         </div>
         <div  class ="width-25 d-flex justify-content-end">
            @if($exercise->custom_id != 0)
               <a class="btn btn-danger delete" role="button" data><i class='fas fa-times'></i></a>
               <a class="btn btn-success ml-2 edit" role"button"><i class='far fa-edit'></i></a>
            @endif
            <a class="btn btn-primary  ml-2 show" role = "button"><i class='far fa-eye'></i></a>
         </div>
   </div >
   </li>
   @endforeach
</ul>
</div>
{{--Modal new exerise--}}
@include('/modalWindows/exerciseModal/newExercise')
{{--End modal--}}

{{--Modal Alter--}}
@include('/modalWindows/exerciseModal/updateExercise')
{{--End Modal--}}
@include('/modalWindows/exerciseModal/deleteExercise')
{{--Modal add photo--}}

@endsection

@section('script')

<script>
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
 if(name !='' && difficulty !='' && difficulty >5 && difficulty < 0){
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

            var id = data.insertedId;
            // Ho l'id della roba inserita
            //add elem to table
            var newIl = '<li class="list-group-item list-group-item-border-li">' +
               '<div class="container_internal">'+
                  '<div  class ="width-25 exercise-name"  data-id='+id+ ' data-name = '+name+'>'+
                      name +
                  '</div>' +
                  '<div class ="width-25 exercise-difficulty  data-difficulty = '+ difficulty+ '" >' +
                      difficulty +
                  '</div>' +
                  '<div class ="width-25">' +
                     1 +
                  '</div>'+
                  '<div  class ="width-25 d-flex justify-content-end">' +
                        '<a class="btn btn-danger delete" role="button">'+
                        '<i class="fas fa-times"></i>' + "</a>" +
                        '<a class="btn btn-success ml-2" role"button">' +
                        '<i class="far fa-edit edit"></i>' + '</a>'+
                        '<a class="btn btn-primary ml-2 show" role = "button">'+
                        '<i class="far fa-eye"></i>'+'</a>'+
                  '</div>'+
            '</div >'+
            '</li>';

            $("#ulTable").prepend(newIl);
            $("#exerciseModal").modal('toggle');
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
      $('#alterExerciseForm').data('id' , id);

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
//record update
$('#exercise_update').on('click', function(ele){
   //get value from input
   var name = $('#update-name').val();
   var difficulty = $('#update-difficulty').val();
   var info = $('#update-info').val();
   if(info == null || info == ''){
         info ="No description";
   }
   if(name !='' && difficulty !='' && difficulty <= 5 && difficulty > 0 ){
   //get id for ajax call
   var id = $('#updateId').data('id');
   jQuery.ajax({
      url:'{{route('exercise.updateExercise')}}',
      type:"post",
      data:{
         "_token": "{{csrf_token()}}",
         id: id,
         name: name,
         difficulty: difficulty,
         info: info,
      },
      success:function(data){
         var li = $('#liTarget').data('li');
         li.find('.exercise-name').html(name);
         li.find('.exercise-difficulty').html(difficulty);
         $('#exercise_update_modal').modal('toggle');
      },
      error:function(){
         alert("Please reload page, noob programmer");
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
      },
      error:function(){
         alert("Please reload page, noob programmer");

      },
   });

});

//end record delete

$('ul').on('click', '.show', function(ele){

   alert("show");

});

});
</script>

@endsection
