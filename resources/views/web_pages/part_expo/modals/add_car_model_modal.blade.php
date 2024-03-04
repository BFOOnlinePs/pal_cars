<div class="modal fade" id="add_car_model_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">إضافة موديل جديد</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="add_car_model_form" method="post">
                {{-- <input name="model_year_id" id="model_year_id" type="text" hidden> --}}

                <div class="form-group">
                    <label for="exampleInputEmail1">الموديل</label>
                    <input type="text" class="form-control" id="new_model_name" name="new_model_name">
                </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
          <button type="button" id="add_model_button" class="btn btn-info">اختر</button>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
