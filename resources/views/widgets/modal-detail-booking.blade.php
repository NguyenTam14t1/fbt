<div class="modal fade" id="modal-detail-booking" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <div class="modal-title">{{ $headerText ?? '' }}</div>
      </div>
      <!-- <div class="modal-body">
          {{ $slot }}
      </div> -->
      {{ $slot }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary yes-confirm" data-dismiss="modal">@lang('admin/global.btn.ok')</button>
      </div>
    </div>
  </div>
</div>
