<footer class="bg-pink-primary border-t border-pink-600 mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Tentang Kami</h3>
                <p class="text-white/90">Web Galeri Sekolah untuk menampilkan berbagai kegiatan dan aktivitas sekolah.</p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('guest.home') }}" class="text-white/90 hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('guest.profil') }}" class="text-white/90 hover:text-white transition">Profil</a></li>
                    <li><a href="{{ route('guest.agenda') }}" class="text-white/90 hover:text-white transition">Agenda</a></li>
                    <li><a href="{{ route('guest.informasi') }}" class="text-white/90 hover:text-white transition">Informasi</a></li>
                    <li><a href="{{ route('guest.galeri') }}" class="text-white/90 hover:text-white transition">Galeri</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Kontak</h3>
                <p class="text-white/90">Email: info@sekolah.sch.id</p>
                <p class="text-white/90">Telp: (0251) 123456</p>
            </div>
        </div>
        
        <div class="border-t border-white/20 mt-8 pt-6 text-center text-white">
            <p>&copy; {{ date('Y') }} Web Galeri Sekolah. All rights reserved.</p>
        </div>
    </div>
</footer>
