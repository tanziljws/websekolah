<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Galery;
use App\Models\Foto;
use App\Models\Testimonial;
use App\Models\Kategori;
use App\Models\User;
use App\Models\HomepageContent;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Show the home page
     */
    public function home()
    {
        try {
            $profile = Profile::first();
        } catch (\Exception $e) {
            $profile = null;
        }
        
        // Get latest Agenda posts
        $latestAgenda = collect();
        try {
            $agendaKategori = Kategori::where('judul', 'Agenda')->first();
            if ($agendaKategori) {
                $latestAgenda = Post::with(['kategori', 'petugas', 'galery.fotos'])
                    ->where('status', 'published')
                    ->where('kategori_id', $agendaKategori->id)
                    ->latest()
                    ->take(4)
                    ->get();
            }
        } catch (\Exception $e) {
            // Database connection error, use empty collection
        }
        
        // Get latest Informasi posts
        $latestInformasi = collect();
        try {
            $informasiKategori = Kategori::where('judul', 'Informasi Terkini')->first();
            if ($informasiKategori) {
                $latestInformasi = Post::with(['kategori', 'petugas', 'galery.fotos'])
                    ->where('status', 'published')
                    ->where('kategori_id', $informasiKategori->id)
                    ->latest()
                    ->take(3)
                    ->get();
            }
        } catch (\Exception $e) {
            // Database connection error, use empty collection
        }
        
        $testimonials = collect();
        try {
            $testimonials = Testimonial::approved()
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            // Database connection error, use empty collection
        }
            
        // Get hero images with metadata
        $heroImages = collect();
        try {
            $heroPath = storage_path('app/public/hero');
            if (is_dir($heroPath)) {
                $files = glob($heroPath . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
                
                // Mapping untuk title dan deskripsi berdasarkan nama file (case-insensitive)
                $heroMetadata = [
                    'senam.jpg' => [
                        'title' => 'Senam Bersama',
                        'description' => 'Kegiatan senam bersama seluruh siswa SMKN 4 BOGOR untuk menjaga kebugaran dan semangat belajar'
                    ],
                    'workshop belajar coding.jpg' => [
                        'title' => 'Workshop Belajar Coding',
                        'description' => 'Program pelatihan coding intensif untuk meningkatkan kemampuan programming siswa jurusan Teknik Komputer dan Jaringan'
                    ],
                    'upacara senin.jpg' => [
                        'title' => 'Upacara Bendera Senin',
                        'description' => 'Kegiatan upacara bendera setiap hari Senin sebagai bentuk pembinaan karakter dan kedisiplinan siswa'
                    ],
                    'smkn4 upacar 17 agustus.png' => [
                        'title' => 'Upacara 17 Agustus',
                        'description' => 'Perayaan Hari Kemerdekaan Republik Indonesia dengan penuh khidmat dan semangat nasionalisme'
                    ]
                ];
                
                foreach ($files as $file) {
                    $filename = basename($file);
                    $filenameLower = strtolower($filename);
                    
                    // Cari metadata dengan matching case-insensitive
                    $metadata = null;
                    foreach ($heroMetadata as $key => $value) {
                        if (strtolower($key) === $filenameLower) {
                            $metadata = $value;
                            break;
                        }
                    }
                    
                    // Fallback jika tidak ditemukan
                    if (!$metadata) {
                        // Extract title dari filename (remove extension, capitalize)
                        $title = pathinfo($filename, PATHINFO_FILENAME);
                        $title = ucwords(str_replace(['_', '-'], ' ', $title));
                        $metadata = [
                            'title' => $title,
                            'description' => 'Menampilkan kegiatan dan aktivitas di SMKN 4 BOGOR'
                        ];
                    }
                    
                    $heroImages->push([
                        'filename' => $filename,
                        'title' => $metadata['title'],
                        'description' => $metadata['description']
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignore error
        }
        
        // Get latest galleries for homepage
        $latestGaleries = collect();
        try {
            $latestGaleries = Galery::with(['post', 'fotos'])
                ->where('status', 1)
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            // Database connection error, use empty collection
        }
        
        // Get statistics for homepage
        $stats = [
            'total_galeries' => 0,
            'total_fotos' => 0,
            'total_posts' => 0,
            'total_users' => 0,
        ];
        
        try {
            $stats['total_galeries'] = Galery::where('status', 1)->count();
            $stats['total_fotos'] = Foto::count();
            $stats['total_posts'] = Post::where('status', 'published')->count();
            $stats['total_users'] = \App\Models\User::where('is_verified', true)->count();
        } catch (\Exception $e) {
            // Database connection error, use default values
        }
        
        // Get homepage content
        $visi = null;
        $misi = collect();
        $prestasi = collect();
        $programs = collect();
        $fasilitas = collect();
        
        try {
            $visi = HomepageContent::getSingleByType('visi');
            $misi = HomepageContent::getByType('misi');
            $prestasi = HomepageContent::getByType('prestasi')->take(5);
            $programs = HomepageContent::getByType('program')->take(4);
            $fasilitas = HomepageContent::getByType('fasilitas')->take(6);
        } catch (\Exception $e) {
            // Database connection error, use defaults
        }
        
        return view('guest.home', compact('profile', 'latestAgenda', 'latestInformasi', 'testimonials', 'heroImages', 'latestGaleries', 'stats', 'visi', 'misi', 'prestasi', 'programs', 'fasilitas'));
    }

    /**
     * Show the profile page
     */
    public function profil()
    {
        try {
            $profile = Profile::first();
        } catch (\Exception $e) {
            $profile = null;
        }
        return view('guest.profil', compact('profile'));
    }

    /**
     * Show the gallery page
     */
    public function galeri(Request $request)
    {
        try {
            $query = Galery::with(['post.kategori', 'fotos'])
                ->where('status', 1);
                
            // Filter by post_id if provided (filtering by specific gallery post title)
            if ($request->has('post') && $request->post) {
                $query->where('post_id', $request->post);
            }
            
            $galeries = $query->orderBy('position')->get();
        } catch (\Exception $e) {
            $galeries = collect();
        }
        
        // Get posts dengan kategori "Galeri Sekolah" for filter chips
        $galeriPosts = collect();
        $filterPosts = collect();
        
        try {
            $galeriKategori = Kategori::where('judul', 'Galeri Sekolah')->first();
            
            if ($galeriKategori) {
                // Posts for content section
                $galeriPosts = Post::with(['kategori', 'petugas'])
                    ->where('status', 'published')
                    ->where('kategori_id', $galeriKategori->id)
                    ->latest()
                    ->take(6)
                    ->get();
                    
                // Posts that have galleries (for filter chips)
                $filterPosts = Post::with(['kategori'])
                    ->where('status', 'published')
                    ->where('kategori_id', $galeriKategori->id)
                    ->whereHas('galeries', function($q) {
                        $q->where('status', 1);
                    })
                    ->latest()
                    ->get();
            }
        } catch (\Exception $e) {
            // Database connection error, use empty collections
        }
            
        return view('guest.galeri', compact('galeries', 'galeriPosts', 'filterPosts'));
    }

    /**
     * Show gallery page with a selected item (full-detail route for hybrid UX)
     */
    public function galeriShow(Galery $galery)
    {
        // Pastikan hanya galeri aktif yang bisa ditampilkan
        abort_unless($galery->status == 1, 404);

        // Increment visitor count
        $galery->increment('total_visitors');

        $galery->load(['post', 'fotos', 'likes', 'bookmarks', 'comments.user', 'comments.children.user']);
        $recommendations = Galery::with('fotos')
            ->where('status', 1)
            ->where('id', '!=', $galery->id)
            ->latest('position')
            ->take(6)
            ->get();

        // Check if user has bookmarked this gallery
        $isBookmarked = false;
        if (auth('user')->check()) {
            $isBookmarked = $galery->bookmarks()
                ->where('user_id', auth('user')->id())
                ->exists();
        }

        // Check if user has liked this gallery
        $isLiked = false;
        if (auth('user')->check()) {
            $isLiked = $galery->likes()
                ->where('user_id', auth('user')->id())
                ->exists();
        }

        return view('guest.galeri_show', compact('galery', 'recommendations', 'isBookmarked', 'isLiked'));
    }

    /**
     * Show agenda page (Posts dengan kategori "Agenda")
     */
    public function agenda()
    {
        try {
            $agendaKategori = Kategori::where('judul', 'Agenda')->first();
            
            if ($agendaKategori) {
                $posts = Post::with(['kategori', 'petugas', 'galery.fotos'])
                    ->where('status', 'published')
                    ->where('kategori_id', $agendaKategori->id)
                    ->latest()
                    ->paginate(9);
            } else {
                // Create empty paginator if no kategori found
                $posts = new \Illuminate\Pagination\LengthAwarePaginator(
                    collect(),
                    0,
                    9,
                    1,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }
        } catch (\Exception $e) {
            // Database connection error, create empty paginator
            $posts = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                9,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
            
        return view('guest.agenda.index', compact('posts'));
    }

    /**
     * Show single agenda detail
     */
    public function agendaShow(Post $post)
    {
        // Pastikan post adalah kategori Agenda dan published
        $agendaKategori = Kategori::where('judul', 'Agenda')->first();
        abort_unless($post->status === 'published' && $post->kategori_id == $agendaKategori->id, 404);
        
        // Increment visitor count
        $post->increment('total_visitors');
        
        $post->load(['kategori', 'petugas', 'galery.fotos']);
        
        // Get related posts (posts lain dengan kategori Agenda)
        $relatedPosts = Post::with(['kategori'])
            ->where('status', 'published')
            ->where('kategori_id', $agendaKategori->id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('guest.agenda.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show informasi page (Posts dengan kategori "Informasi Terkini")
     */
    public function informasi()
    {
        try {
            $informasiKategori = Kategori::where('judul', 'Informasi Terkini')->first();
            
            if ($informasiKategori) {
                $posts = Post::with(['kategori', 'petugas', 'galery.fotos'])
                    ->where('status', 'published')
                    ->where('kategori_id', $informasiKategori->id)
                    ->latest()
                    ->paginate(9);
            } else {
                // Create empty paginator if no kategori found
                $posts = new \Illuminate\Pagination\LengthAwarePaginator(
                    collect(),
                    0,
                    9,
                    1,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }
        } catch (\Exception $e) {
            // Database connection error, create empty paginator
            $posts = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                9,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
            
        return view('guest.informasi.index', compact('posts'));
    }

    /**
     * Show single informasi detail
     */
    public function informasiShow(Post $post)
    {
        // Pastikan post adalah kategori Informasi Terkini dan published
        $informasiKategori = Kategori::where('judul', 'Informasi Terkini')->first();
        abort_unless($post->status === 'published' && $post->kategori_id == $informasiKategori->id, 404);
        
        // Increment visitor count
        $post->increment('total_visitors');
        
        $post->load(['kategori', 'petugas', 'galery.fotos']);
        
        // Get related posts (posts lain dengan kategori Informasi Terkini)
        $relatedPosts = Post::with(['kategori'])
            ->where('status', 'published')
            ->where('kategori_id', $informasiKategori->id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('guest.informasi.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the contact page
     */
    public function kontak()
    {
        return view('guest.kontak');
    }
}
