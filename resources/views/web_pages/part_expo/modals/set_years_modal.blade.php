<div class="modal fade" id="set_years_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">اختيار السنوات</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="set_years_form" method="post">
                <input name="model_year_id" id="model_year_id" type="text" hidden>

                <div class="form-group">
                    <label for="exampleInputEmail1">السنوات</label>
                    <select class="form-control select2bs4" multiple="multiple"  id="years"name="years" style="width: 100%;"></select>
                </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-info">اختر</button>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
