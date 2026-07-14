<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author','category')
            ->published()
            ->latest('published_at')
            ->paginate(10);

        $latest = Post::published()->latest('published_at')->take(6)->get();
        $popular = Post::published()->orderByDesc('view_count')->take(5)->get();
        $headerMenu = MenuItem::header()->get();
        $categories = Category::orderBy('name')->get();

        return view('home', compact('posts','latest','popular','headerMenu','categories'));
    }

    public function show(Post $post)
    {
        if ($post->status === 'published') {
            $post->increment('view_count');
            DB::statement("
                INSERT INTO post_views (post_id, view_date, views)
                VALUES (?, CURDATE(), 1)
                ON DUPLICATE KEY UPDATE views = views + 1
            ", [$post->id]);
        }

        $related = Post::published()
            ->where('id','!=',$post->id)
            ->where('category_id',$post->category_id)
            ->latest('published_at')
            ->take(4)->get();

        return view('post.show', compact('post','related'));
    }

    public function byCategory(Category $category)
    {
        $posts = Post::published()
            ->where('category_id',$category->id)
            ->latest('published_at')->paginate(10);

        $latest = Post::published()->latest('published_at')->take(6)->get();
        $popular = Post::published()->orderByDesc('view_count')->take(5)->get();
        $categories = Category::orderBy('name')->get();

        return view('home', compact('posts','latest','popular','categories'))->with('activeCategory',$category);
    }

    public function search(Request $request)
    {
        $q = trim($request->get('q',''));
        $cat = $request->get('category');

        $posts = Post::published()
            ->when($q, fn($qq)=>$qq->where(function($w) use($q){
                $w->where('title','like',"%$q%")
                  ->orWhere('content','like',"%$q%");
            }))
            ->when($cat, fn($qq)=>$qq->whereHas('category', fn($c)=>$c->where('slug',$cat)))
            ->latest('published_at')->paginate(10)->appends($request->query());

        $latest = Post::published()->latest('published_at')->take(6)->get();
        $popular = Post::published()->orderByDesc('view_count')->take(5)->get();
        $categories = Category::orderBy('name')->get();

        return view('search', compact('posts','latest','popular','q','categories','cat'));
    }
}