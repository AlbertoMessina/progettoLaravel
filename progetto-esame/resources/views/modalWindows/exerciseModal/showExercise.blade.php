<x-showModal class="showExerciseModal" >
@slot('modalTitle' , 'Exercise info')
@slot('modalId' , 'exercise_show_modal')
@slot('rightTitle' , "")

<div class = "carousel-show-container">

   <div id="carouselShowExercise" class="carousel slide carousel-show-exercise" data-ride="carousel">
     <ol class="carousel-indicators carousel-indicators-exercise">

     </ol>
     <div class="carousel-inner carousel-inner-exercise">

     </div>
     <a class="carousel-control-prev" href="#carouselShowExercise" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselShowExercise" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
     </a>
   </div>

</div>
<div class="infoContainer">
   <h6 class="infoLabel"><span>INFO</span><h6>
   <span id="show-info"></span>
</div>

</x-showModal>
