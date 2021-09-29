@extends("front.layouts.master")
@section("title","İletişim")
@section("content")
@section("bg","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXs8jRl_PYdCEdKZsb3ZEm-prB4etQSvEbilvaozvtHb8BjyRkR1YSqFZrJgnKpBE2PSg&usqp=CAU")
<div class="col-md-8 col-xl-7">
    @if(session("success"))
        <div class="alert alert-success">
            {{session("success")}}
        </div>
    @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>

        @endif


    <p>Bizimle İletişime Geçebilirsiniz!</p>
    <div class="my-5">
        <form method="post" action="{{route("contact.post")}}">
            @csrf
            <div class="form-floating">
                <input class="form-control" id="name" name="name" type="text" value="{{old("name")}}" placeholder="Enter your name..." required/>
                <label for="name">Ad - Soyad</label>
                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
            </div>
            <div class="form-floating">
                <input class="form-control" id="email" name="email" type="email" value="{{old("email")}}" placeholder="Enter your email..." required/>
                <label for="email">Email Adres</label>
                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
            </div>
            <div class="form-floating">
                <label for="topic">Konu</label>
                <select id="topic" class="form-control" name="topic">
                    <option>Bilgi</option>
                    <option>İstek</option>
                    <option>Genel Bilgi</option>
                </select>
                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" >{{old("message")}}</textarea>
                <label for="message">Mesajınız</label>
                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
            </div>
            <br />
            <button class="btn btn-primary" type="submit">Gönder</button>
        </form>
    </div>
</div>
<div class="col-md-4">
    asdfasdf
</div>

@endsection


