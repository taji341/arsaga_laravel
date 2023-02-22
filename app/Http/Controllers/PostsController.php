<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Folder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\CreatePosts;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id): View
    {
        $folders = Folder::all();
        $current_folder = Folder::find($id);
        $posts = $current_folder->posts()->get();

        return view('posts/index', [
        'folders' => $folders,
        'current_folder_id' => $current_folder->id,
        'posts' => $posts,
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
        
        return redirect()->route('posts.index', [
            'id' => $post->folder_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post): RedirectResponse
    {
        $post->delete();

        return redirect(route('posts.index', [
            'id' => $post->folder_id,
        ]));
    }
}
