<!-- The Modal -->
<div id="{{ $modalId }}" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header modal-header-text">

      <h4 class="modal-title font-weight-bold">{{ $modalTitle }}</h4>
      <span class="close" onclick="closeModal(this)">&times;</span>
    </div>
    <div class="modal-body">
      {{ $slot }}
    </div>

  </div>

</div>