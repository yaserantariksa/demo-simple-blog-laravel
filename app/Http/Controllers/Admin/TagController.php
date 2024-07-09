<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Tag;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required'
        ]);

        $title = Str::lower($request->title);

        if (!Tag::firstWhere('title', $title)) {
            $tag = [
                'title' => $title,
                'slug' => Str::slug($title, '-'),
            ];
            Tag::create($tag);

            return redirect()->route('tags.index');
        }

        return back()->withErrors(['title' => "Tag is exist!"])->withInput();
    }

    public function destroy(string $slug): RedirectResponse
    {
        $tag = Tag::firstWhere('slug', $slug);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
