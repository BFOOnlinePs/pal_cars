<table class="table table-striped" id="carsModelsTable">
    <thead>
        <tr>
          <th>موديل السيارة</th>
          <th>استعراض صورة الموديل</th>
          <th>العمليات</th>
        </tr>
      </thead>
      <tbody>
          @if ($data->isEmpty())
          <tr>
              <td colspan="3" class="text-center"><span>لا توجد بيانات</span></td>
          </tr>
          @else
          @foreach ($data as $key)
          <tr>
              <td>{{$key->car_model}}</td>
              <td>
                <img src="{{ asset('storage/uploads/carModelsPics/' . $key->car_model_pic) }}" style="cursor: pointer;" width="50px"  alt="" onclick="openPic({{$key}})">
              </td>
              <td>
                {{-- <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </div> --}}
                <button class="btn btn-secondary" onclick="editCarModel({{$key}})"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="deleteCarModel({{$key}})"><i class="fas fa-trash"></i></button>
              </td>
          </tr>
          @endforeach
          @endif
      </tbody>
</table>
