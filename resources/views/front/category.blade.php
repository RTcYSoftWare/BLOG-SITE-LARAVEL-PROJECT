@extends("front.layouts.master")
@section("title",$category->name." Kategorisi | ".count($articles)." Yazı Bulundu")
@section("content")

    <div class="col-md-9 col-xl-7">

        @if(count($articles) > 0)
            @foreach($articles as $article)
                <div class="post-preview">
                    <a href="{{route("single", [$article->getCategory->slug, $article->slug])}}">
                        <h2 class="post-title">{{$article->title}}</h2>
                        <img src="{{$article->image}}">
                        <h3 class="post-subtitle">{{str_limit($article->content,75)}}</h3>
                    </a>
                    <p class="post-meta">
                        Kategori:
                        <a href="#!">{{$article->getCategory->name}}</a>
                        <span class="float-end"> {{$article->created_at->diffForHumans()}} </span>
                    </p>
                </div>
                @if(!$loop->last)
                    <hr class="my-4" />
                @endif
            @endforeach
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        @else
            <div class="alert alert-danger">
                <h1>Bu Kategoriye Ait Yazı Bulunamadı</h1>
            </div>
        @endif


    </div>
    @include("front.widgets.kategoriWidget")

@endsection
