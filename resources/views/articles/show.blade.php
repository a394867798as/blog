@extends('app')
@section('title',$title)
@section('content')
    <article class="format-image group">
        <h2 class="post-title pad">
            <a href="/article/show/{{ $article->aid }}" rel="bookmark"> {{ $article->atitle }}</a>
        </h2>
        <div class="post-inner">
            <div class="post-content pad">
                <div class="entry custome">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </article>
@endsection