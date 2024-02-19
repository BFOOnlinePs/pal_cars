<div class="modal fade" id="edit_car_type_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">تعديل نوع سيارة</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="EditCarTypeForm" method="post">
                <input name="edit_type_id" id="edit_type_id" type="text" hidden>
                {{-- <input type="text" class="form-control" id="edit_type_name" name="edit_type_name">
                <input type="text" class="form-control" id="edit_note" name="edit_note">
                <input type="file" id="edit_logo" name="edit_logo"> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">نوع السيارة</label>
                    <input type="text" class="form-control" id="edit_type_name" name="edit_type_name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملاحظات</label>
                    <input type="text" class="form-control" id="edit_note" name="edit_note">
                </div>

                <div class="form-group">
                    <label for="formFile" class="form-label">الشعار</label>
                    <input class="form-control" type="file" id="edit_logo" name="edit_logo">
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
