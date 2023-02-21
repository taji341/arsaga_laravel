<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function create(CreateFolder $request): RedirectResponse
    {
        $folder = new Folder();
        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('posts.index', [
            'id' => $folder->id,
    ]);
    }
}
