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
                <div class="row">
                    <div class="col-md-12 pt-5">
                        <h2>Comments</h2>
                        <div class="list-group">
                            @foreach($comments as $comment)
                                <div class="list-group-item mb-4 border-1 rounded-3" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $comment->user->name }}</h5>
                                        <small>{{ $comment->created_at }}</small>
                                    </div>
                                    <p class="mb-1">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                        @auth
                            <div class="card">
                                <div class="card-body">
                                    @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            {{Session::get('success')}}
                                        </div>
                                    @endif
                                    <form method="post" action="{{ route('comment.store', $new->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="news-content" class="form-label">Comment</label>
                                            <textarea class="form-control" id="news-content" rows="3" name="comment"></textarea>
                                            @error('comment')
                                            <div class="alert alert-danger bg-transparent p-0 border-0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Write comment</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-light">
                                <a href="{{ route('login') }}">Log in</a> to write comments
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h2>Suggestions</h2>
                <div class="row">
                    @foreach($related_news as $related)
                        <div class="col-12 mb-2">
                            <a class="card text-decoration-none text-secondary" href="{{ route('news.show', $related->slug) }}">
                                <img src="{{ $related->image }}" class="card-img-top" alt="{{ $related->title }}">
                                <div class="card-body">
                                    <p class="card-text fs-5 lh-base">{{ $related->title }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
