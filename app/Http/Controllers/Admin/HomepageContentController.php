<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use Illuminate\Http\Request;

class HomepageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = HomepageContent::orderBy('type')->orderBy('order')->get()->groupBy('type');
        
        // Get existing or default data
        $visi = HomepageContent::getSingleByType('visi');
        $misi = HomepageContent::where('type', 'misi')->orderBy('order')->get();
        $prestasi = HomepageContent::getByType('prestasi');
        $programs = HomepageContent::getByType('program');
        $fasilitas = HomepageContent::getByType('fasilitas');
        
        return view('admin.homepage.index', compact('visi', 'misi', 'prestasi', 'programs', 'fasilitas'));
    }

    /**
     * Store or update content
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:visi,misi,prestasi,program,fasilitas',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'meta' => 'nullable|array'
        ]);

        // For single content types (visi), update or create
        if ($validated['type'] === 'visi') {
            $content = HomepageContent::updateOrCreate(
                ['type' => 'visi'],
                [
                    'title' => $validated['title'] ?? null,
                    'content' => $validated['content'],
                    'icon' => $validated['icon'] ?? null,
                    'is_active' => $validated['is_active'] ?? true,
                    'order' => 0
                ]
            );
        } else {
            // For multiple content types
            $content = HomepageContent::create([
                'type' => $validated['type'],
                'title' => $validated['title'] ?? null,
                'content' => $validated['content'],
                'icon' => $validated['icon'] ?? null,
                'meta' => $validated['meta'] ?? null,
                'order' => $validated['order'] ?? HomepageContent::where('type', $validated['type'])->max('order') + 1,
                'is_active' => $validated['is_active'] ?? true
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil disimpan',
            'content' => $content
        ]);
    }

    /**
     * Update the specified resource
     */
    public function update(Request $request, $id)
    {
        $content = HomepageContent::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'meta' => 'nullable|array'
        ]);

        $content->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil diupdate',
            'content' => $content->fresh()
        ]);
    }

    /**
     * Remove the specified resource
     */
    public function destroy($id)
    {
        $content = HomepageContent::findOrFail($id);
        $content->delete();

        return response()->json([
            'success' => true,
            'message' => 'Content berhasil dihapus'
        ]);
    }

    /**
     * Get content for preview
     */
    public function preview(Request $request)
    {
        $type = $request->input('type');
        $contents = HomepageContent::where('type', $type)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'contents' => $contents
        ]);
    }
}
