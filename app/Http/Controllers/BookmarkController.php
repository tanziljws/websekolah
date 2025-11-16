<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request, Galery $galery)
    {
        $userId = auth('user')->id() ?? auth()->id();
        if (!$userId) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return redirect()->route('user.login');
        }

        $existing = Bookmark::where('user_id', $userId)->where('galery_id', $galery->id)->first();
        $isBookmarked = false;
        
        if ($existing) {
            $existing->delete();
            session()->flash('success', 'Galeri berhasil dihapus dari simpanan.');
        } else {
            Bookmark::create(['user_id' => $userId, 'galery_id' => $galery->id]);
            $isBookmarked = true;
            session()->flash('success', 'Galeri berhasil disimpan!');
        }

        if ($request->wantsJson() || $request->ajax()) {
            $count = Bookmark::where('galery_id', $galery->id)->count();
            return response()->json([
                'bookmarks' => $count,
                'is_bookmarked' => $isBookmarked
            ]);
        }

        return back();
    }
}
