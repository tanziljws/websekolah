<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Galery;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Get or create Informasi Terkini category
     */
    private function getInformasiKategori()
    {
        $kategori = Kategori::where('judul', 'Informasi Terkini')->first();
        
        // Auto-create jika belum ada
        if (!$kategori) {
            $kategori = Kategori::create([
                'judul' => 'Informasi Terkini'
            ]);
        }
        
        return $kategori;
    }

    public function index()
    {
        $informasiKategori = $this->getInformasiKategori();
        $posts = Post::with(['kategori', 'galery'])
            ->where('kategori_id', $informasiKategori->id)
            ->latest()
            ->paginate(10);
        
        return view('admin.informasi.index', compact('posts'));
    }

    public function create()
    {
        $galeries = Galery::where('status', 1)->with(['post', 'fotos'])->get();
        return view('admin.informasi.create', compact('galeries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
            'galery_id' => 'nullable|exists:galery,id'
        ]);

        $informasiKategori = $this->getInformasiKategori();

        Post::create([
            'judul' => $request->judul,
            'kategori_id' => $informasiKategori->id,
            'isi' => $request->isi,
            'status' => $request->status,
            'petugas_id' => null,
            'galery_id' => $request->galery_id,
        ]);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dibuat!');
    }

    public function show($informasi)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($informasi);
        
        $informasiKategori = $this->getInformasiKategori();
        
        // Pastikan post adalah informasi
        if ($post->kategori_id != $informasiKategori->id) {
            abort(404);
        }
        
        $post->load(['kategori', 'galery']);
        return view('admin.informasi.show', compact('post'));
    }

    public function edit($informasi)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($informasi);
        
        $informasiKategori = $this->getInformasiKategori();
        
        // Pastikan post adalah informasi
        if ($post->kategori_id != $informasiKategori->id) {
            abort(404);
        }
        
        $galeries = Galery::where('status', 1)->with(['post', 'fotos'])->get();
        return view('admin.informasi.edit', compact('post', 'galeries'));
    }

    public function update(Request $request, $informasi)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($informasi);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
            'galery_id' => 'nullable|exists:galery,id'
        ]);

        $informasiKategori = $this->getInformasiKategori();
        
        // Pastikan post adalah informasi
        if ($post->kategori_id != $informasiKategori->id) {
            abort(404);
        }

        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
            'galery_id' => $request->galery_id ?: null, // Allow null to remove link
        ]);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diupdate!');
    }

    public function destroy($informasi)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($informasi);
        
        $informasiKategori = $this->getInformasiKategori();
        
        // Pastikan post adalah informasi
        if ($post->kategori_id != $informasiKategori->id) {
            abort(404);
        }
        
        $post->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus!');
    }
}

