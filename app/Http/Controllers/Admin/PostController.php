<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'like', "%$search%")->latest()->paginate(10);

        return view('admin.posts.index', compact('posts','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'title' => 'required|max:70',
            'image' => 'image|max:2650',
            'content' => 'required',
        ]);

        $title = $request->title;
        $slug = Str::slug($title, '-');

        if (count(Post::where('slug', $slug)->get()) == 0) {

            $image = $request->file('image');

            if ($image) {
                $image->storeAs('public/upload', $image->hashName());
            }

            $post = [
                'title' => $title,
                'slug' => $slug,
                'user_id' => $request->user_id,
                'image' => $image ? $image->hashName() : null,
                'content' => $request->content,
                'is_draft' => $request->boolean('is_draft') ? true : false,
            ];

            $saved_post = Post::create($post);

            $tags = $request->tags;

            $saved_post->tags()->attach($tags);

            return redirect()->route('posts.show', $saved_post->slug);
        }

        return back()->withErrors(['title' => 'Title is already exist'])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::firstWhere('slug', $slug);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $post = Post::firstWhere('slug', $slug);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $post = Post::firstWhere('slug', $slug);

        // VALIDATE INPUT
        $request->validate([
            'title' => 'required',
            'image' => 'image|max:2650',
            'content' => 'required',
        ]);

        $updatedTitle = $request->title;
        $updatedSlug = Str::slug($updatedTitle, '-');
        $updatedImage = $request->file('image');


        if (count(Post::where('slug', $updatedSlug)->get()) < 2) {

            if ($updatedImage) {
                // UPLOAD NEW IMAGE
                $updatedImage->storeAs('public/upload', $updatedImage->hashName());

                // DELETE OLD IMAGE
                Storage::delete('public/upload/' . $post->image);

                $post->update([
                    'title' => $updatedTitle,
                    'slug' => $updatedSlug,
                    'user_id' => $request->user_id,
                    'image' => $updatedImage->hashName(),
                    'content' => $request->content,
                    'is_draft' => $request->boolean('is_draft') ? true : false,
                ]);
            } else {
                $post->update([
                    'title' => $updatedTitle,
                    'slug' => $updatedSlug,
                    'user_id' => $request->user_id,
                    'content' => $request->content,
                    'is_draft' => $request->boolean('is_draft') ? true : false,
                ]);
            }

            $oldtags = [];
            foreach ($post->tags as $tag) {
                $oldtags[] = $tag->id;
            }
            $newtags = $request->tags;

            if (array_diff($oldtags, $newtags)) {
                $post->tags()->detach(array_diff($oldtags, $newtags));
            }
            if (array_diff($newtags, $oldtags)) {
                $post->tags()->attach(array_diff($newtags, $oldtags));
            }

            return redirect()->route('posts.show', $post->slug);
        }

        return back()->withErrors(['title', 'Other post with same title is exist, submit another title.'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $slug)
    {
        $post = Post::firstWhere('slug', $slug);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
