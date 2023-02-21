<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Folder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->posts()->create($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $post): View
    {
        // 本人のみアクセスを承認
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $post): RedirectResponse
    {
        // $this->authorize('update', $post);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $post->update($validated);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post): RedirectResponse
    {
        // $this->authorize('delete', $post);

        $post->delete();

        return redirect(route('posts.index'));
    }
}
