@extends("back.layouts.master")
@section("title", "Tüm Adminler")
@section("content")
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Tüm Adminler</h6>
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$adminler->count()}}</strong> Admin bulundu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th>Email</th>
                        <th>İzinler</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($adminler as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @foreach($item->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" target="_blank" title="Görüntüle" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @role("SupperAdmin")
                                    <a href="{{route("admin.adminler.edit-admin",$item->id)}}" title="Düzenle" class="btn btn-sm btn-primary">
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
