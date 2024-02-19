<table class="table table-striped" id="carsTypeTable">
    <thead>
        <tr>
          <th>نوع السيارة</th>
          <th>الشعار</th>
          <th>العمليات</th>
          <th>إدارة الموديلات</th>
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
              <td>{{$key->car_type}}</td>
              {{-- <td><img src="{{ asset($key->logo) }}" width="50px" height="50px" alt=""></td> --}}
              {{-- <td><img src="{{ asset($key->logo) }}" width="50px" alt=""></td> --}}
              <td><img src="{{ asset('storage/uploads/carTypeLogo/' . $key->logo) }}" width="50px" alt=""></td>
              <td>
                <button class="btn btn-secondary" onclick="editCarType({{$key}})"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="deleteCarType({{$key}})"><i class="fas fa-trash"></i></button>
              </td>
              <td><button class="btn btn-info" onclick='location.href="{{route("dashboard.settings.cars_type.car_models",["id"=>$key->id])}}"'><i class="fas fa-search"></i></button></td>
          </tr>
          @endforeach
          @endif
      </tbody>

</table>
