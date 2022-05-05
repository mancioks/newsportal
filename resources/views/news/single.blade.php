@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-4 p-md-5 mb-4 text-white pb-5 rounded"
             style="background-image: url('{{ $new->image }}');background-size: cover;">
            <div class="col-md-6 px-0 mb-5">
                <h1 class="display-10 fst-italic pb-5">{{ $new->title }}</h1>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-8">
                <article class="blog-post">
                    <p class="blog-post-meta">{{ $new->created_at }} by <a href="#">{{ $new->user->name }}</a></p>

                    <p>{!! nl2br($new->content) !!}</p>
                </article>
            </div>
        </div>
    </div>
@endsection
