@extends("front.layouts.master")
@section("title",$article->title)
@section("content")
@section("bg",$article->image)
    <div class="col-md-9 col-lg-8 col-xl-7">
        <h2 class="section-heading">{{$article->title}}</h2>
        <p>{{$article->content}}</p>
        {!! $article->content !!}
        <p></p>
        <span class="text-danger">Okunma Sayısı : <b>{{$article->hit}}</b></span>
    </div>

    @include("front.widgets.kategoriWidget")

@endsection

