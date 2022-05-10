@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($news as $new)
            <div class="col-4 mb-2">
                <a class="card text-decoration-none text-secondary" href="{{ route('news.show', $new->slug) }}">
                    <img src="{{ $new->image }}" class="card-img-top" alt="{{ $new->title }}">
                    <div class="card-body">
                        <p class="card-text fs-5 lh-base">{{ $new->title }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div>
        {{ $news->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
