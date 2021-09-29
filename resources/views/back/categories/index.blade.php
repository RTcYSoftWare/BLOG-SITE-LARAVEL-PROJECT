@extends("back.layouts.master")
@section("title", "Tüm Kategoriler")
@section("content")

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Ekle</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route("admin.category.create")}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Kategori Ekle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield("title")</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->Article_Count()}}</td>
                                    <td>
                                        <input class="tgl_switch" data-key="{{$item->id}}" type="checkbox"
                                               data-on="Aktif"
                                               data-onstyle="success" data-off="Pasif" data-offstyle="danger"
                                               @if($item->status == 1) checked @endif data-toggle="toggle">
                                    </td>
                                    <td>
                                        <a href="" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i
                                                class="fa fa-eye"></i></a>
                                        <a data-kategori_id="{{$item->id}}" title="Düzenle"
                                           class="a_categories_edit btn btn-sm btn-primary">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a title="Sil" data-kategori_id="{{$item->id}}"
                                           data-kategori_count="{{$item->Article_Count()}}"
                                           class="a_categories_delete btn btn-sm btn-danger">
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
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route("admin.category.update")}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <labe>Kategori Adı</labe>
                            <input id="inp_model_cateogry" type="text" class="form-control" name="category">
                            <input id="inp_model_cateogry_id" type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <labe>Kategori Slug</labe>
                            <input id="inp_model_slug" type="text" class="form-control" name="slug">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="deleteModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="model-body" class="model-body">
                    <div id="div_category_count_alert" class="alert alert-danger">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <form action="{{route("admin.category.delete")}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="inp_delteModel_deleted_id">
                        <button id="btn_deleteModel_delete" type="submit" class="btn btn-success">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section("css")
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section("js")
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $(".a_categories_edit").click(function () {
                id = $(this).data("kategori_id");
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{route("admin.category.getdata")}}",
                    data: {id: id},
                    success: function (data) {
                        console.log(data);
                        $("#editModal").modal();
                        $("#inp_model_cateogry_id").val(data.id);
                        $("#inp_model_cateogry").val(data.name);
                        $("#inp_model_slug").val(data.slug);
                    }
                })
            });

            $(".a_categories_delete").click(function () {
                $("#div_category_count_alert").html("");
                $("#model-body").hide();

                id = $(this).data("kategori_id");
                //makale_sayisi = $(this).closest("tr").find("td").eq(1).text();
                makale_sayisi = $(this).data("kategori_count");

                if(id == 1){
                    $("#model-body").show();
                    $("#div_category_count_alert").html("Bu Kategori Genel Kategoridir. Silinemez !!!");
                    $("#btn_deleteModel_delete").hide();
                }
                else{
                    $("#inp_delteModel_deleted_id").val(id);
                    $("#btn_deleteModel_delete").show();
                    if (makale_sayisi > 0) {
                        $("#model-body").show();
                        $("#div_category_count_alert").html("Bu Kategoriye Ati " + makale_sayisi + " Adet Makele Bulunmaktadır. Silmek İstediğinize Emin Misiniz ?");
                    }
                }

                $("#deleteModel").modal();

            });

            $('.tgl_switch').change(function () {

                id = $(this).data("key");
                statu = $(this).prop('checked');
                $.get("{{route("admin.category.switch")}}", {id: id, statu: statu}, function (data, status) {
                });
            })
        })
    </script>
@endsection


