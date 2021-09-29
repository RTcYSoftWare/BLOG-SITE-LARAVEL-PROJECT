@extends("back.layouts.master")
@section("title", "Silinmiş Makaleler")
@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{$articles->count()}}</strong> makale bulundu
                <a href="{{route("admin.makaleler.index")}}" class="btn btn-success btn-sm"><i class="fa fa-globe"></i> Yayındaki Makaleler</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($articles as $item)
                        <tr>
                            <td>
                                <img src="{{$item->image}}>" width="150">
                            </td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->getCategory->name}}</td>
                            <td>{{$item->hit}}</td>
                            <td>{{$item->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route("admin.recover.article",$item->id)}}" title="Makaleyi Kurtar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                <a href="{{route("admin.hard.delete.article",$item->id)}}" title="Gerçekten Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


{{--{!!  $item->status == 0 ? "<span class='text-danger'> Pasif</span>" : "<span class='text-success'> Aktif</span>" !!}--}}
