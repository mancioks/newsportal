<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if(!auth()->check() || auth()->user()->role->name != 'publisher')
//            abort(403);



        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $new = new News();
        $new->title = $request->post('title');
        $new->content = $request->post('content');
        $new->user_id = Auth::id();
        $new->category_id = $request->post('category_id');
        $new->image = $request->post('image_url');
        $new->views = 0;
        $new->slug = 0;
        $new->save();

        $slug = Str::slug($request->post('title'));

        if(News::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $new->id;
        }

        $new->slug = $slug;
        $new->save();

        return redirect()->route('news.show', $new->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $new = News::where('slug', $slug)->firstOrFail();

        //$comments = $new->comments()->paginate(5);
        $comments = $new->comments()->latest()->get();

        $related_news = News::where('category_id', $new->category_id)->whereNot('id', $new->id)->get();

        return view('news.single', compact('new', 'comments', 'related_news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::findOrFail($id);
        $categories = Category::all();

        return view('news.edit', compact('new', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $new = News::findOrFail($id);
        $new->title = $request->post('title');
        $new->content = $request->post('content');
        $new->category_id = $request->post('category_id');
        $new->image = $request->post('image_url');
        $new->save();

        return redirect()->route('news.edit', $new->slug)->withSuccess('Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
