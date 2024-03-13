<div class="table-responsive">
    <table class="table table-striped table-bordered">
        {{-- <table class="table mt-3"> --}}
        <thead>
        <tr>
            <th>اللون</th>
            <th>تعديل</th>
        </tr>
        </thead>
        <tbody id="colorsTableBody">
            @if ($data->isEmpty())
                <tr>
                    <td colspan="2" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
            @else
                @foreach ($data as $key)
                <tr>
                    <td>{{$key->color}}</td>
                    <td><button class="btn btn-sm btn-success text-white" onclick="edit_color({{$key}})"><i class="fas fa-edit"></i></button></td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
