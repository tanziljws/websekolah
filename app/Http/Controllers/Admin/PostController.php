<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['kategori'])->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.posts.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published'
        ]);

        Post::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
            'petugas_id' => null, // Set null karena sudah tidak digunakan
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dibuat!');
    }

    public function show(Post $post)
    {
        $post->load(['kategori']);
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $kategoris = Kategori::all();
        return view('admin.posts.edit', compact('post', 'kategoris'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published'
        ]);

        $post->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'status' => $request->status,
            // petugas_id tetap tidak diupdate
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil diupdate!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dihapus!');
    }
}
