<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::query()->published()->with('category')->latest('published_at');

        if ($category = $request->string('category')->toString()) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        if ($search = $request->string('q')->toString()) {
            $query->where(fn ($q) => $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%"));
        }

        return view('blog.index', [
            'posts' => $query->paginate(9)->withQueryString(),
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->status === 'published', 404);

        return view('blog.show', [
            'post' => $post,
            'related' => Post::query()->published()->where('id', '!=', $post->id)
                ->where('category_id', $post->category_id)
                ->take(3)->get(),
        ]);
    }
}
