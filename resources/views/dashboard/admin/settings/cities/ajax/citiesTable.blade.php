<table class="table table-striped" id="citiesTable">
    <thead>
        <tr>
          {{-- <th style="width: 10px">#</th> --}}
          <th>المدينة</th>
          <th>تعديل</th>
        </tr>
      </thead>
      <tbody>
          @if ($data->isEmpty())
          <tr>
              <td colspan="2" class="text-center"><span>لا توجد بيانات</span></td>
          </tr>
          @else
          @foreach ($data as $key)
          <tr>
              <td>{{$key->city_name}}</td>
              <td><button class="btn btn-secondary" onclick="editCity({{$key}})"><i class="fas fa-edit"></i></button></td>
          </tr>
          @endforeach
          @endif
      </tbody>
  </table>
