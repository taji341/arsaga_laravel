<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Folder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\CreatePosts;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $id): View
    {
        $folders = Auth::user()->folders()->get();
        $current_folder = Folder::find($id);
        $keyword = $request->input('keyword');
        $from = $request->input('from');
        $to = $request->input('to');
        $query = Posts::query();

        if(!empty($keyword)) {
            $query->where('message', 'LIKE', "%{$keyword}%")
                    ->where('folder_id', $current_folder->id);
            $posts = $query->get();
        }elseif(!empty($from && $to)) {
            $query->whereBetween('date',[$from, $to])
                    ->where('folder_id', $current_folder->id);
            $posts = $query->get();
        }else{
            $posts = $current_folder->posts()->get();
        }

        return view('posts/index', [
        'folders' => $folders,
        'current_folder_id' => $current_folder->id,
        'posts' => $posts,
        'keyword' => $keyword,
        'from' => $from,
        'to' => $to
    ]);
    }

    public function create(int $id): View
    {
    return view('posts/create', [
        'folder_id' => $id
    ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(int $id, CreatePosts $request): RedirectResponse
    {
        $current_folder = Folder::find($id);

        $post = new Posts();
        $post->message = $request->message;
        $post->date = $request->date;

        $current_folder->posts()->save($post);

        return redirect()->route('posts.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, int $post_id): View
    {
        $post = Posts::find($post_id);

        return view('posts/edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, int $post_id, CreatePosts $request): RedirectResponse
    {
        $post = Posts::find($post_id);
        $post->message = $request->message;
        $post->date = $request->date;
        $post->save();
        
        return redirect()->route('posts.index', [
            'id' => $post->folder_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, int $post_id): RedirectResponse
    {
        $post = Posts::find($post_id);
        $post->delete();

        return redirect()->route('posts.index', [
            'id' => $post->folder_id,
        ]);
    }
}
