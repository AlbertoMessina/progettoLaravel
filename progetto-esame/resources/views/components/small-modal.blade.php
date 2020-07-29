
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div  id="genericModalContent" class="modal-content ">
      <div class="modal-header text-center">
        <h4 class="modal-title font-weight-bold">{{ $modalTitle }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

      {{ $slot }}

      </div>
      <div class="modal-footer j-c-center">
        <button id="{{$modalSubmitButton}}" class="btn btn-success btn-unique">{{$modalButton}}</button>
      </div>

    </div>
  </div>
</div>
