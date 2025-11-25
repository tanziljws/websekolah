<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use App\Models\Galery;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Get or create Agenda category
     */
    private function getAgendaKategori()
    {
        $kategori = Kategori::where('judul', 'Agenda')->first();
        
        // Auto-create jika belum ada
        if (!$kategori) {
            $kategori = Kategori::create([
                'judul' => 'Agenda'
            ]);
        }
        
        return $kategori;
    }

    public function index()
    {
        $agendaKategori = $this->getAgendaKategori();
        $posts = Post::with(['kategori', 'galery'])
            ->where('kategori_id', $agendaKategori->id)
            ->latest()
            ->paginate(10);
        
        return view('admin.agenda.index', compact('posts'));
    }

    public function create()
    {
        $galeries = Galery::where('status', 1)->with(['post', 'fotos'])->get();
        return view('admin.agenda.create', compact('galeries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
            'galery_id' => 'nullable|exists:galery,id'
        ]);

        $agendaKategori = $this->getAgendaKategori();

        Post::create([
            'judul' => $request->judul,
            'kategori_id' => $agendaKategori->id,
            'isi' => $request->isi,
            'status' => $request->status,
            'petugas_id' => null,
            'galery_id' => $request->galery_id,
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dibuat!');
    }

    public function show($agenda)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($agenda);
        
        $agendaKategori = $this->getAgendaKategori();
        
        // Pastikan post adalah agenda
        if ($post->kategori_id != $agendaKategori->id) {
            abort(404);
        }
        
        $post->load(['kategori', 'galery']);
        return view('admin.agenda.show', compact('post'));
    }

    public function edit($agenda)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($agenda);
        
        $agendaKategori = $this->getAgendaKategori();
        
        // Pastikan post adalah agenda
        if ($post->kategori_id != $agendaKategori->id) {
            abort(404);
        }
        
        $galeries = Galery::where('status', 1)->with(['post', 'fotos'])->get();
        return view('admin.agenda.edit', compact('post', 'galeries'));
    }

    public function update(Request $request, $agenda)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($agenda);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
            'galery_id' => 'nullable|exists:galery,id'
        ]);

        $agendaKategori = $this->getAgendaKategori();
        
        // Pastikan post adalah agenda
        if ($post->kategori_id != $agendaKategori->id) {
            abort(404);
        }

        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
            'galery_id' => $request->galery_id ?: null, // Allow null to remove link
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diupdate!');
    }

    public function destroy($agenda)
    {
        // Resolve Post model dari route parameter
        $post = Post::findOrFail($agenda);
        
        $agendaKategori = $this->getAgendaKategori();
        
        // Pastikan post adalah agenda
        if ($post->kategori_id != $agendaKategori->id) {
            abort(404);
        }
        
        $post->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus!');
    }
}

