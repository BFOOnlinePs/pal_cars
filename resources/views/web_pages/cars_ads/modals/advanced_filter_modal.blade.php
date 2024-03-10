<div class="modal fade" id="advanced_filter_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">البحث المتقدم</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="advanced_filter_form" method="post">
                <div class="card-body">
                    {{-- <h5>FILTER LIST</h5> --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6><span class="fa fa-car mr-2"></span>مواصفات السيارة</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">لون السيارة</label>
                                        <select id="car_color" name="car_color" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--اللون--</option>
                                            @foreach ($colors as $color)
                                            <option value="">{{$color->color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عدد الركاب</label>
                                        <select id="seats_number" name="seats_number" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--عدد الركاب--</option>
                                            @foreach ($seats as $seat)
                                            <option value="{{$seat}}">{{$seat}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نوع الوقود</label>
                                        <select id="diesel" name="diesel" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--نوع الوقود--</option>
                                            <option value="ديزل">ديزل</option>
                                            <option value="بنزين">بنزين</option>
                                            <option value="هايبرد">هايبرد</option>
                                            <option value="كهرباء">كهرباء</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نوع الجير</label>
                                        <select id="geer_type" name="geer_type" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--نوع الجير--</option>
                                            <option value="عادي">عادي</option>
                                            <option value="أوتوماتيك">أوتوماتيك</option>
                                            <option value="نصف أوتوماتيك">نصف أوتوماتيك</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الزجاج</label>
                                        <select id="glass" name="glass" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--الزجاج--</option>
                                            <option value="إلكتروني">إلكتروني</option>
                                            <option value="يدوي">يدوي</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عداد السيارة</label>
                                        <select id="counter" name="counter" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--العداد--</option>
                                            <option value="1">0 - 20,000</option>
                                            <option value="2">20,000 - 50,000</option>
                                            <option value="3">50,000 - 100,000</option>
                                            <option value="4">100,000 - 150,000</option>
                                            <option value="5">< 150,000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">قوة الماتور</label>
                                        <select id="car_motor_size" name="car_motor_size" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--العداد--</option>
                                            <option value="1">500 - 1000</option>
                                            <option value="2">1000 - 2000</option>
                                            <option value="3">2000 - 3000</option>
                                            <option value="4">3000 - 4000</option>
                                            <option value="5">4000 - 5000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6><span class="fa fa-info-circle icon-star mr-2"></span>معلومات السيارة</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">عدد المالكين السابقين</label>
                                        <select id="old_owners" name="old_owners" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--العدد--</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">أصل السيارة</label>
                                        <select id="car_sours" name="car_sours" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--الأصل--</option>
                                            {{-- <option value="">أصل السيارة</option> --}}
                                            <option value="خصوصي">خصوصي</option>
                                            <option value="عمومي">عمومي</option>
                                            <option value="تأجير">تأجير</option>
                                            <option value="تدريب سياقة">تدريب سياقة</option>
                                            <option value="تجاري">تجاري</option>
                                            <option value="حكومي">حكومي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">رخصة السيارة</label>
                                        <select id="agreement" name="agreement" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--الرخصة--</option>
                                            <option value="فلسطينية">فلسطينية</option>
                                            <option value="نمرة صفراء">نمرة صفراء</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6><span class="fa fa-bullhorn icon-star mr-2"></span>معلومات الإعلان</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">معروضة لـ</label>
                                        <select id="view_for" name="view_for" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--معروضة لـ--</option>
                                            <option value="البيع">البيع</option>
                                            <option value="التبديل">التبديل</option>
                                            <option value="البيع والتبديل">البيع والتبديل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">السعر</label>
                                        <select id="price" name="price" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--السعر--</option>
                                            <option value="1">0 - 10,000</option>
                                            <option value="2">10,000 - 20,000</option>
                                            <option value="3">20,000 - 30,000</option>
                                            <option value="4">30,000 - 40,000</option>
                                            <option value="5">40,000 - 50,000</option>
                                            <option value="6">50,000 - 60,000</option>
                                            <option value="7">60,000 - 70,000</option>
                                            <option value="8">70,000 - 80,000</option>
                                            <option value="9">80,000 - 90,000</option>
                                            <option value="10">< 100,000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">طريقة الدفع</label>
                                        <select id="payment_method" name="payment_method" class="form-control select2" style="width: 100%;">
                                            <option value="" selected>--طريقة الدفع--</option>
                                            <option value="تقسيط">نقداً</option>
                                            <option value="تقسيط">تقسيط</option>
                                            <option value="نصف نقداً ونصف تقسيط">نصف نقداً ونصف تقسيط</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> تطبيق الفلترة</button>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
