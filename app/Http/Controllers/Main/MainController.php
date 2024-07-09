<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->input('search');
        $search_by_tag = $request->query('tag');

        if ($search_by_tag) {
            $posts = Post::whereHas('tags', function (Builder $query) use ($search_by_tag) {
                $query->where('slug', "=", $search_by_tag);
            })
                ->latest()
                ->simplePaginate(10);
        } else {
            $posts = Post::where('title', 'like', "%$search%")
                ->orWhereHas('tags', function (Builder $query) use ($search) {
                    $query->where('slug', 'like', "%$search%");
                })
                ->latest()
                ->simplePaginate(10);
        }

        $tags = Tag::all();

        return view('main.index', compact('posts', 'tags', 'search', 'search_by_tag'));
    }
}
