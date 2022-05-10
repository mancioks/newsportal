@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search results @if($news) "{{ request()->get('s') }}": @endif</h2>
    <div class="row">
        @forelse($news as $new)
            <div class="col-4 mb-2">
                <a class="card text-decoration-none text-secondary" href="{{ route('news.show', $new->slug) }}">
                    <img src="{{ $new->image }}" class="card-img-top" alt="{{ $new->title }}">
                    <div class="card-body">
                        <p class="card-text fs-5 lh-base">{{ $new->title }}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                No results
            </div>
        @endforelse
    </div>
    <div>
        @if($news)
            {{ $news->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
@endsection
