<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $q = Post::with('author','category')
            ->when(!$user->isAdmin(), fn($qq)=>$qq->where('user_id',$user->id))
            ->latest('updated_at');

        $posts = $q->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|max:255',
            'category_id'=>'nullable|exists:categories,id',
            'content'=>'required',
            'status'=>'required|in:draft,published',
            'cover_image'=>'nullable|image|max:2048'
        ]);

        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['title']).'-'.Str::random(5);
        $plain = $this->plainText($data['content']);
        $data['excerpt'] = Str::limit($plain, 220);
        $data['meta_title'] = $data['title'];
        $data['meta_description'] = Str::limit($plain, 155);
        if ($data['status']==='published') $data['published_at'] = now();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('posts','public');
        }

        Post::create($data);
        return redirect()->route('posts.index')->with('ok','Post berhasil dibuat.');
    }

    public function edit(Post $post, Request $request)
    {
        $user = $request->user();
        if (!$user->isAdmin() && $post->user_id !== $user->id) abort(403);

        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $user = $request->user();
        if (!$user->isAdmin() && $post->user_id !== $user->id) abort(403);

        $data = $request->validate([
            'title'=>'required|max:255',
            'category_id'=>'nullable|exists:categories,id',
            'content'=>'required',
            'status'=>'required|in:draft,published',
            'cover_image'=>'nullable|image|max:2048'
        ]);

        $plain = $this->plainText($data['content']);
        $data['excerpt'] = Str::limit($plain, 220);
        $data['meta_title'] = $data['title'];
        $data['meta_description'] = Str::limit($plain, 155);
        if ($data['status']==='published' && !$post->published_at) $data['published_at'] = now();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('posts','public');
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('ok','Post berhasil diupdate.');
    }

    public function destroy(Post $post, Request $request)
    {
        $user = $request->user();
        if (!$user->isAdmin() && $post->user_id !== $user->id) abort(403);

        $post->delete();
        return back()->with('ok','Post dihapus.');
    }

    private function plainText(string $html): string
    {
        return Str::of($html)
            ->replace(['<br>', '<br/>', '<br />'], "\n")
            ->replaceMatches('/<\/(p|div|li|h[1-6]|blockquote)>/i', "\n")
            ->stripTags()
            ->squish()
            ->value();
    }
}
