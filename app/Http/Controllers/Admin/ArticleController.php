<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class ArticleController extends Controller
{
    public function index()
    {
        // show up to 4 articles
        $articles = Article::orderBy('created_at','desc')->take(4)->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'external_link' => 'nullable|url|max:255',
            'category' => 'nullable|in:sejarah,artikel_umum',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        // prevent adding more than 4
        if (Article::count() >= 4) {
            return back()->withErrors(['limit' => 'Maksimal 4 artikel terdaftar. Hapus terlebih dahulu untuk menambah.'])->withInput();
        }

        $thumbUrl = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('articles','public');
            $thumbUrl = 'storage/'.$path;
        }

        Article::create([
            'title' => $data['title'],
            'external_link' => $data['external_link'] ?? null,
            'category' => $data['category'] ?? 'artikel_umum',
            'thumbnail_url' => $thumbUrl,
        ]);

        return redirect()->route('admin.articles.index')->with('status','Article added');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'external_link' => 'nullable|url|max:255',
            'category' => 'nullable|in:sejarah,artikel_umum',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // remove old
            if ($article->thumbnail_url && str_starts_with($article->thumbnail_url,'storage/')) {
                $old = public_path($article->thumbnail_url);
                if (file_exists($old)) @unlink($old);
            }
            $path = $request->file('thumbnail')->store('articles','public');
            $article->thumbnail_url = 'storage/'.$path;
        }

        $article->title = $data['title'];
        $article->external_link = $data['external_link'] ?? null;
        $article->category = $data['category'] ?? 'artikel_umum';
        $article->save();

        return redirect()->route('admin.articles.index')->with('status','Article updated');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail_url && str_starts_with($article->thumbnail_url,'storage/')) {
            $old = public_path($article->thumbnail_url);
            if (file_exists($old)) @unlink($old);
        }
        $article->delete();
        return back()->with('status','Article removed');
    }
}
