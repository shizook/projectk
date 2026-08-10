<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    // --- FITUR MENGELOLA POSTINGAN (CREATE, STORE, EDIT, UPDATE) ---

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

 public function store(Request $request)
{
    // 1. Validasi dasar input wajib
    $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,heic|max:5120',
    ]);

    // 2. Upload foto sampul
    $imagePath = null;
    if ($request->hasFile('cover_image')) {
        $imagePath = $request->file('cover_image')->store('posts', 'public');
    }

    // 3. AMBIL PAKSA SUMBER FOTO DARI FORM (Cek semua kemungkinan key)
    $sumberFoto = $request->input('cover_source') 
               ?? $request->input('cover_image_source') 
               ?? $request->cover_source 
               ?? $request->cover_image_source;

    // 4. INSTANSIASI DAN SIMPAN LANGSUNG KE MODEL (TANPA VIA $validated)
    $post = new \App\Models\Post();
    $post->user_id      = \Illuminate\Support\Facades\Auth::id() ?? 1;
    $post->category_id  = $request->input('category_id');
    $post->title        = $request->input('title');
    $post->slug         = \Illuminate\Support\Str::slug($request->input('title')) . '-' . time();
    $post->content      = $request->input('content');
    $post->cover_image  = $imagePath;
    $post->cover_source = $sumberFoto; // <-- Disimpan paksa di sini
    $post->status       = $request->input('status', 'published');
    
    if ($post->status === 'published') {
        $post->published_at = now();
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat!');
}
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'status'      => 'required|in:draft,published',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:5120',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        $validated['cover_source'] = $request->input('cover_source') ?? $request->input('cover_image_source');

        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }
}