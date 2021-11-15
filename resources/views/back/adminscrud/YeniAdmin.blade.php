@extends("back.layouts.master")
@section("title", "Admin Oluştur")
@section("content")

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield("title")</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route("admin.adminler.yeni-admin-post")}}">
                @csrf
                <div class="form-group">
                    <label>Ad - Soyad</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Rol</label>
                    <select class="form-control" name="role">
                        <option value="">Seçim Yapınız</option>
                        @foreach($roller as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mail</label>
                    <input type="text" name="mail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Şifre</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Admin Oluştur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
