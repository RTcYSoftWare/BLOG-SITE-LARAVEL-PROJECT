@extends("back.layouts.master")
@section("title", "Tüm Sayfalar")
@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$pages->count()}}</strong> makale bulundu
                <a href="{{route("admin.trashed.article")}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody id="orders">
                    @foreach($pages as $item)
                        <tr id="page_{{$item->id}}">
                            <td class="text-center" style="width: 5px">
                                <i class="fa fa-arrows-alt fa-2x handle" style="cursor: move"></i>
                            </td>
                            <td>
                                <img src="{{url($item->image)}}" width="150">
                            </td>
                            <td>{{$item->title}}</td>
                            <td>
                                <input class="tgl_switch" data-key="{{$item->id}}" type="checkbox" data-on="Aktif"
                                       data-onstyle="success" data-off="Pasif" data-offstyle="danger"
                                       @if($item->status == 1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a href="{{(route("page",$item->slug))}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route("admin.page.update",$item->id)}}" title="Düzenle" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="{{route("admin.page.delete",$item->id)}}" title="Sil" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section("css")
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section("js")
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
        $("#orders").sortable({
            handle:".handle",
            update:function (){
                var siralama = $("#orders").sortable("serialize");
                //console.log(siralama);
                $.get("{{route("admin.page.orders")}}?"+siralama,function (data,status){
                    console.log(status);
                });
            }
        });

    </script>
    <script>
        $(function () {
            $('.tgl_switch').change(function () {
                id = $(this).data("key");
                statu = $(this).prop('checked');
                $.get("{{route("admin.page.switch")}}", {id:id, statu:statu}, function (data, status) {
                });
            })
        })
    </script>
@endsection

{{--{!!  $item->status == 0 ? "<span class='text-danger'> Pasif</span>" : "<span class='text-success'> Aktif</span>" !!}--}}
