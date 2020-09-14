<x-genericModal>
   @slot('modalTitle' , 'Delete Exercise')
   @slot('modalId' , 'exercise_modal_delete')



<label> Are you sure to delete? </label>
<div style="display:none" id="deletedId"> </div>
<div style="display:none" id="deleteli"> </div>
<div class="center-centered">
  <input type='submit' id="exercise_delete"  class="btn btn-success btn-unique" value='DELETE'>
</div>
</x-genericModal>
