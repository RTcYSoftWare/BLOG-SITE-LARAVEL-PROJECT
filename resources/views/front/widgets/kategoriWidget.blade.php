@isset($kategoriler)
<div class="col-md-3">
    <div clas="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @foreach($kategoriler as $kategori)

                <a href="{{route("category",$kategori->slug)}}" class="@if(Request::segment(2) == $kategori->slug) ative @endif list-group-item">{{$kategori->name}}
                    <span class="badge bg-black float-end">{{$kategori->Article_Count()}}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
