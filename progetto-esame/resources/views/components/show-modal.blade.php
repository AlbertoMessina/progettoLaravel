
   <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header text-center">
           <h4 class="modal-title show-left-title font-weight-bold">{{ $modalTitle }}</h4>
           <h4 class="modal-title show-right-title ">{{$rightTitle}} </h4>           
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body mx-3">
         {{ $slot }}
         </div>
       </div>
     </div>
   </div>
