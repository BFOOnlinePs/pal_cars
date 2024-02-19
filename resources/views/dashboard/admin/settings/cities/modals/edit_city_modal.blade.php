<div class="modal fade" id="edit_city_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">تعديل مدينة</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="EditCityForm" method="post">
                <input name="edit_city_id" id="edit_city_id" type="text" hidden>
                <input type="text" class="form-control" id="edit_city_name" name="edit_city_name">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-info">حفظ التعديل</button>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
