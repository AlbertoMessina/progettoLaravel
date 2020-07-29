
<x-genericModal>
   @slot('modalTitle' , 'Delete Exercise')
   @slot('modalId' , 'exercise_modal_delete')
   @slot('modalSubmitButton' , 'exercise_delete')
   @slot('modalButton' , 'delete')

<label> Are you sure to delete? </label>
<div style="display:none" id="deletedId"> </div>
<div style="display:none" id="deleteli"> </div>
</x-genericModal>
