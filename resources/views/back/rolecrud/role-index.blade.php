@extends("back.layouts.master")
@section("title", "Tüm Roller")
@section("content")
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Tüm Roller</h6>
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$roller->count()}}</strong> Rol bulundu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th>Koruma İsmi</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Güncelleme Tarihi</th>
                        <th>İzinler</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roller as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->guard_name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                @if($item->permissions->count() > 0)
                                @foreach($item->permissions as $permission)
                                    "{{$permission->name}}",
                                @endforeach
                                @else
                                    Bu Role Ait İzin Bulunamadı!
                                @endif
                            </td>
                            <td>
                                @role("SupperAdmin")
                                <a href="{{route("admin.roller.edit-role",$item->id)}}" title="Düzenle" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="{{route("admin.adminler.delete-admin",$item->id)}}" title="Sil" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endrole
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
