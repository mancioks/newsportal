@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create new') }}</div>

                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        <form method="post" action="{{ route('news.update', $new->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-start">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="news-title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="news-title" name="title" value="{{ $new->title }}">
                                        @error('title')
                                        <div class="alert alert-danger bg-transparent p-0 border-0">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="news-category" class="form-label">Category</label>
                                        <select class="form-select" id="news-category" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $new->category_id) selected @endif >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-danger bg-transparent p-0 border-0">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="news-image" class="form-label">Image url</label>
                                        <input type="text" class="form-control" id="news-image" name="image_url" value="{{ $new->image }}">
                                        @error('image_url')
                                        <div class="alert alert-danger bg-transparent p-0 border-0">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="news-content" class="form-label">Content</label>
                                <textarea class="form-control" id="news-content" rows="3" name="content">{{ $new->content }}</textarea>
                                @error('content')
                                <div class="alert alert-danger bg-transparent p-0 border-0">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
