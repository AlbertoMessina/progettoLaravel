
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog {{ $modalDialogClass }}" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-text">

        <h4 class="modal-title font-weight-bold">{{ $modalTitle }}</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      {{ $slot }}

      </div>


    </div>
  </div>
</div>
