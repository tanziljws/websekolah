<footer class="bg-gray-100 border-t border-gray-200 mt-12">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tentang Kami</h3>
                <p class="text-gray-600">Web Galeri Sekolah untuk menampilkan berbagai kegiatan dan aktivitas sekolah.</p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('guest.home') }}" class="text-gray-600 hover:text-pink-primary transition">Beranda</a></li>
                    <li><a href="{{ route('guest.profil') }}" class="text-gray-600 hover:text-pink-primary transition">Profil</a></li>
                    <li><a href="{{ route('guest.agenda') }}" class="text-gray-600 hover:text-pink-primary transition">Agenda</a></li>
                    <li><a href="{{ route('guest.informasi') }}" class="text-gray-600 hover:text-pink-primary transition">Informasi</a></li>
                    <li><a href="{{ route('guest.galeri') }}" class="text-gray-600 hover:text-pink-primary transition">Galeri</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Kontak</h3>
                <p class="text-gray-600">Email: info@sekolah.sch.id</p>
                <p class="text-gray-600">Telp: (0251) 123456</p>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-8 pt-6 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} Web Galeri Sekolah. All rights reserved.</p>
        </div>
    </div>
</footer>
