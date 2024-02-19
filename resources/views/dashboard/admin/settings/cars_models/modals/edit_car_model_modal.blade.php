<div class="modal fade" id="edit_car_model_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">تعديل موديل سيارة</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="EditCarModelForm" method="post">
                <input name="edit_model_id" id="edit_model_id" type="text" hidden>

                <div class="form-group">
                    <label for="exampleInputEmail1">موديل السيارة</label>
                    <input type="text" class="form-control" id="edit_model_name" name="edit_model_name">
                </div>

                <div class="form-group">
                    <label for="formFile" class="form-label">صورة الموديل</label>
                    <input class="form-control" type="file" id="edit_pic" name="edit_pic">
                </div>
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
