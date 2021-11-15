@extends("back.layouts.master")
@section("title", "Rol Güncelle")
@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">"{{$role->name}}" İsimli Rolü ve İzinlerini
                Güncelliyorsunuz</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route("admin.adminler.edit-admin-post")}}">
                @csrf
                <input type="hidden" name="id" class="form-control" value="{{$role->id}}" readonly>
                <div class="form-group">
                    <label>İsim</label>
                    <input type="text" name="name" class="form-control" value="{{$role->name}}" required>
                </div>
                <div class="form-group">
                    <label>Koruma İsmi</label>
                    <input type="text" name="email" class="form-control" value="{{$role->guard_name}}" required>
                </div>
                <div class="form-group">
                    <label>Oluşturulma Tarih</label>
                    <input type="text" name="" class="form-control" value="{{$role->created_at}}" readonly>
                </div>
                <div class="form-group">
                    <label>Güncellenme Tarih</label>
                    <input type="text" name="" class="form-control" value="{{$role->updated_at}}" readonly>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xl-6 ">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Rol'e Ait İzinler </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        @foreach($role->permissions as $item)
                                            <label for="label-{{$item->id}}"> {{$item->name}}</label>
                                            <input id="label-{{$item->id}}" type="checkbox"
                                                   class="form-control checkbox_role_edit_permissions"
                                                   data-key="{{$item->id}}" checked>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Rol Dışı İzinler </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        @foreach($permissions as $item)

                                            <label for="label-{{$item->id}}"> {{$item->name}}</label>
                                            <input id="label-{{$item->id}}" type="checkbox"
                                                   class="form-control checkbox_role_edit_permissions"
                                                   data-key="{{$item->id}}">

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Admin Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("js")
    <script>
        $(document).ready(function () {
            $(".checkbox_role_edit_permissions").change(function () {
                var id = $(this).data("key");
                var durum = $(this).prop("checked");
                var role_id = {{$role->id}};
                console.log("İD = " + id + " Data = " + durum + " Rol İD'si = " + role_id);
                $.ajax({
                    url: "{{route("admin.roller.give-to-permission")}}",
                    type: "GET",
                    data: {id: id, durum: durum, role_id: role_id},
                    success: function (data, status) {
                        console.log(data + status);
                    }
                })
            });

        });


    </script>

@endsection




{{--<option @if($admin->hasRole($item->name)) selected @endif value="{{$item->id}}">{{$item->name}}</option>--}}
{{--hasRole() metodunu biz yazmadık. spatie'nin modelinde  hazır yazılmış olan metod bu şekilde kullanılır.--}}
