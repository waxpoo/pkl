<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Food - Kontak Kami</title>
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body>
    <header>
        <div class="logo">TASTY FOOD</div>
        <nav>
            <ul>
                <li><a href="http://127.0.0.1:8000/">HOME</a></li>
                <li><a href="tentang-kami">TENTANG</a></li>
                <li><a href="berita-kami">BERITA</a></li>
                <li><a href="galeri-kami">GALERI</a></li>
                <li><a href="kontak-kami">KONTAK</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <img src="asd.png" alt="Hero Image">
        <div class="hero-text">KONTAK KAMI</div>
    </section>

    <main>
        <section class="contact-form">
            <h2>KONTAK KAMI</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="/kontak" method="POST">
                @csrf
                <div class="form-left">
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-right">
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Message" required></textarea>
                    </div>
                </div>
                <button type="submit">KIRIM</button>
            </form>
        </section>
        <section class="contact-info">
            <div class="info-item">
                <div class="info-item-content">
                    <img src="email.png" alt="Email Icon" class="icon-image">
                    <h4>EMAIL</h4>
                    <p>tastyfood@gmail.com</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-item-content">
                    <img src="telephone.png" alt="Phone Icon" class="icon-image">
                    <h4>PHONE</h4>
                    <p>+62 812 3456 7890</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-item-content">
                    <img src="lokasi.png" alt="Location Icon" class="icon-image">
                    <h4>LOCATION</h4>
                    <p>Kota Bandung, Jawa Barat</p>
                </div>
            </div>
        </section>
        @php
        // Ambil peta berdasarkan ID yang sesuai
        $map = App\Models\Map::first(); // Pastikan ini sesuai dengan ID peta yang ingin ditampilkan
    @endphp
    
    <section class="map" style="text-align: center; margin: 20px 0;">
        @if ($map && $map->latitude && $map->longitude) 
            <div id="map" style="width: 80%; height: 450px; margin: 0 auto;"></div> 
            
            <script>
                // Inisialisasi peta dengan koordinat dari database
                var map = L.map('map').setView([{{ $map->latitude }}, {{ $map->longitude }}], 13); 
    
                // Menambahkan layer peta dari OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);
    
                // Menambahkan marker di peta
                L.marker([{{ $map->latitude }}, {{ $map->longitude }}]).addTo(map)
                    .bindPopup('Lokasi: Kota Bandung, Jawa Barat'); 
            </script>
            
            <!-- Menampilkan gambar -->
            @if ($map->image) <!-- Pastikan ada data gambar -->
                <img src="{{ asset('storage/' . $map->image) }}" alt="Peta Lokasi" style="width: 100%; margin-top: 20px;"/>
            @endif
            
        @else
            <p>Data peta tidak tersedia atau koordinat tidak valid.</p> 
        @endif
    </section>
        

        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Tasty Food</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat.</p>
                    <div class="social-icons">
                        <a href="#"><img src="{{ asset('001-facebook.png') }}" alt="Facebook"></a>
                        <a href="#"><img src="{{ asset('002-twitter.png') }}" alt="Twitter"></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Useful links</h3>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Hewan</a></li>
                        <li><a href="#">Galeri</a></li>
                        <li><a href="#">Testimonial</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Privacy</h3>
                    <ul>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak Kami</a></li>
                        <li><a href="#">Servis</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>tastyfood@gmail.com</p>
                    <p>+62 812 3456 7890</p>
                    <p>Kota Bandung, Jawa Barat</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 All rights reserved</p>
            </div>
        </footer>
    </main>
</body>

</html>
