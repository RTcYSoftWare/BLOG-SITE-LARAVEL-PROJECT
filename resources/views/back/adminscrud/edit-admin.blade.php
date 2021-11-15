@extends("back.layouts.master")
@section("title", "Admin Güncelle")
@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">"{{$admin->name}}" İsimli Admini Güncelliyorsunuz</h6>
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
                <input type="hidden" name="id" class="form-control" value="{{$admin->id}}" readonly>
                <div class="form-group">
                    <label>Ad - Soyad</label>
                    <input type="text" name="name" class="form-control" value="{{$admin->name}}" required>
                </div>
                <div class="form-group">
                    <label>Rol</label>
                    <select class="form-control" name="role">
                        <option value="">Seçim Yapınız</option>
                        @foreach($roller as $item)
                            <option @if($admin->hasRole($item->name)) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mail</label>
                    <input type="text" name="email" class="form-control" value="{{$admin->email}}" required>
                </div>
                <div class="form-group">
                    <label>Eklenme Tarih</label>
                    <input type="text" name="" class="form-control" value="{{$admin->created_at}}" readonly>
                </div>
                <div class="form-group">
                    <label>Güncellenme Tarih</label>
                    <input type="text" name="" class="form-control" value="{{$admin->updated_at}}" readonly>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Admin Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection


{{--<option @if($admin->hasRole($item->name)) selected @endif value="{{$item->id}}">{{$item->name}}</option>--}}
{{--hasRole() metodunu biz yazmadık. spatie'nin modelinde  hazır yazılmış olan metod bu şekilde kullanılır.--}}
