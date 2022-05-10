<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $new_id)
    {
        News::findOrFail($new_id);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->comment = $request->post('comment');
        $comment->ip = $request->ip();
        $comment->news_id = $new_id;
        $comment->save();

        return redirect()->back()->withSuccess('Comment added successfully');
    }
}
