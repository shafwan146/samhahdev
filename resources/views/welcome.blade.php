<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Samhah Farm - Peternakan ayam kampung berkualitas di Jakarta Timur. Anda Belanja, Anda Beramal!">
    <meta name="keywords" content="ayam kampung, ayam pelung, pitik pelung, DOC, Jakarta Timur, peternakan ayam">
    <title>Samhah Farm - Ayam Kampung Berkualitas</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="#" class="logo">
                    <img src="{{ asset('images/logo-transparent.png') }}" alt="Samhah Farm Logo">
                </a>
                
                <ul class="nav-links" id="navLinks">
                    <li><a href="#beranda" class="active">Beranda</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#produk">Produk</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#lokasi">Lokasi</a></li>
                </ul>
                
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    🌿 <span>Peternakan Alami Sejak 2024</span>
                </div>
                <h1>Ayam Kampung <span>Berkualitas</span> untuk Keluarga Indonesia</h1>
                <p class="hero-subtitle">
                    Dipelihara secara alami dengan pakan bergizi dan perawatan terbaik. 
                    Sehat, segar, dan siap dipasarkan sesuai kebutuhan Anda.
                </p>
                <div class="hero-cta">
                    <a href="https://wa.me/6281292761950" class="btn btn-primary" target="_blank">
                        📱 Hubungi Kami
                    </a>
                    <a href="#produk" class="btn btn-secondary">
                        Lihat Produk
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/pitik-pelung.jpg') }}" alt="Samhah Farm Hero">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="container">
            <div class="about-image">
                <img src="{{ asset('images/logo.jpg') }}" alt="Tentang Samhah Farm">
                <!-- <div class="about-badge">
                    <strong>20%</strong>
                    <span>Untuk Amal</span>
                </div> -->
            </div>
            <div class="about-content">
                <h2>Tentang <span>Samhah Farm</span></h2>
                <p class="about-description">
                    Samhah Farm berdiri pada 1 Januari 2024 di Jakarta Timur sebagai peternakan ayam kampung 
                    yang berfokus menyediakan ayam kampung hidup berkualitas bagi masyarakat. 
                    Dengan metode pemeliharaan alami, ayam kampung dibesarkan dalam lingkungan sehat, 
                    diberi pakan bergizi, dan dirawat secara higienis.
                </p>
                
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">🌱</div>
                        <span class="feature-text">Pemeliharaan Alami</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🌾</div>
                        <span class="feature-text">Pakan Bergizi</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✨</div>
                        <span class="feature-text">Perawatan Higienis</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">💚</div>
                        <span class="feature-text">Ayam Sehat & Segar</span>
                    </div>
                </div>
                
                <div class="mission-box">
                    <h4>❤️ "Anda Belanja, Anda Beramal"</h4>
                    <p>
                        Setiap transaksi di Samhah Farm, 20% dari keuntungan langsung disalurkan untuk kegiatan sosial. 
                        Dengan prinsip "Sehat, Segar, dan Berkah", kami mengajak pelanggan berbagi kebaikan 
                        dalam setiap belanja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="produk">
        <div class="container">
            <div class="section-title">
                <h2>Produk <span>Kami</span></h2>
                <p>Ayam Kampung Berkualitas untuk Segala Kebutuhan</p>
            </div>
            
            <div class="products-grid">
                <!-- Ayam Pelung -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/products/ayam-pelung.jpg') }}" alt="Ayam Pelung Samhah Farm" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="product-image-placeholder" style="display: none;">
                            <span class="placeholder-icon">🐓</span>
                            <span class="placeholder-text">Foto Ayam Pelung</span>
                        </div>
                        <span class="product-badge">Best Seller</span>
                    </div>
                    <div class="product-content">
                        <h3>Ayam Pelung</h3>
                        <p>
                            Ayam Pelung Samhah Farm dikenal dengan badan yang lebih besar dan daging yang lebih padat, 
                            sehingga hasil olahannya mantap untuk berbagai menu. Dipelihara dengan perawatan yang baik 
                            agar tetap sehat dan segar.
                        </p>
                        <a href="https://wa.me/6281292761950?text=Halo%20Samhah%20Farm,%20saya%20tertarik%20dengan%20Ayam%20Pelung" class="btn btn-primary product-cta" target="_blank">
                            📱 Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Pitik Pelung -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/products/ayam-pelung-doc.jpeg') }}" alt="Pitik Pelung DOC Samhah Farm" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="product-image-placeholder" style="display: none;">
                            <span class="placeholder-icon">🐣</span>
                            <span class="placeholder-text">Foto Pitik Pelung</span>
                        </div>
                        <span class="product-badge orange">DOC</span>
                    </div>
                    <div class="product-content">
                        <h3>Pitik Pelung (DOC)</h3>
                        <p>
                            Pitik Pelung 1-2 bulan adalah bibit ayam pelung usia starter yang sudah lebih kuat dan 
                            mudah beradaptasi. Cocok untuk pembesaran hingga panen atau dipelihara sebagai ayam 
                            pelung unggulan.
                        </p>
                        <a href="https://wa.me/6281292761950?text=Halo%20Samhah%20Farm,%20saya%20tertarik%20dengan%20Pitik%20Pelung" class="btn btn-primary product-cta" target="_blank">
                            📱 Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimoni">
        <div class="container">
            <div class="section-title">
                <h2>Apa Kata <span>Pelanggan</span></h2>
                <p>Pengalaman mereka bersama Samhah Farm</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="{{ asset('images/testimonials/Testimoni-2.jpg') }}" alt="Testimoni Pak Rusdi" onerror="this.parentElement.classList.add('no-image');">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">
                            "Ayam dari Samhah Farm dagingnya empuk dan rasanya beda dari ayam biasa. 
                            Cocok banget buat sop dan masakan tradisional. Pasti order lagi!"
                        </p>
                        <div class="testimonial-author">
                            <h4>Pak Rusdi</h4>
                            <span>Pegawai, Jakarta</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-image">
                        <img src="{{ asset('images/testimonials/Testimoni2-2.jpeg') }}" alt="Testimoni Pak Ahmad" onerror="this.parentElement.classList.add('no-image');">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">
                            "Saya beli pitik pelung dari Samhah Farm untuk dijadikan breeding stock. 
                            Kualitasnya bagus, sehat-sehat, dan pengirimannya aman. Recommended!"
                        </p>
                        <div class="testimonial-author">
                            <h4>Pak Ahmad</h4>
                            <span>Peternak, Jakarta</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="location" id="lokasi">
        <div class="container">
            <div class="section-title">
                <h2>Lokasi <span>Kami</span></h2>
                <p>Kunjungi langsung peternakan kami di Jakarta Timur</p>
            </div>
            
            <div class="location-grid">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.42665395732!2d106.8739817!3d-6.3387454000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ecfda343e5d3%3A0x7e27f57289e58ceb!2sGg.%20Persatuan%2C%20Klp.%20Dua%20Wetan%2C%20Kec.%20Ciracas%2C%20Kota%20Jakarta%20Timur%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1768489343706!5m2!1sid!2sid"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <div class="location-info">
                    <h3>Informasi Lokasi</h3>
                    <div class="location-details">
                        <div class="location-item">
                            <div class="location-icon">📍</div>
                            <div class="location-text">
                                <h4>Alamat</h4>
                                <p>Jakarta Timur, DKI Jakarta</p>
                            </div>
                        </div>
                        <div class="location-item">
                            <div class="location-icon">🕐</div>
                            <div class="location-text">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Sabtu: 08:00 - 17:00 WIB</p>
                            </div>
                        </div>
                        <div class="location-item">
                            <div class="location-icon">📞</div>
                            <div class="location-text">
                                <h4>Telepon</h4>
                                <p><a href="tel:+6281292761950">+62 812-9276-1950</a></p>
                            </div>
                        </div>
                        <div class="location-item">
                            <div class="location-icon">💬</div>
                            <div class="location-text">
                                <h4>WhatsApp</h4>
                                <p><a href="https://wa.me/6281292761950" target="_blank">Chat via WhatsApp</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo-transparent.png') }}" alt="Samhah Farm">
                        <!-- <span>SAMHAH FARM</span> -->
                    </div>
                    <p>
                        Peternakan ayam kampung berkualitas di Jakarta Timur. 
                        Dengan moto "Anda Belanja, Anda Beramal", kami hadir untuk menyediakan 
                        ayam kampung sehat, segar, dan berkah.
                    </p>
                </div>
                
                <div class="footer-column">
                    <h4>Navigasi</h4>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#produk">Produk</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Produk</h4>
                    <ul class="footer-links">
                        <li><a href="#produk">Ayam Pelung</a></li>
                        <li><a href="#produk">Pitik Pelung (DOC)</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Kontak</h4>
                    <ul class="footer-links">
                        <li><a href="https://wa.me/6281292761950" target="_blank">WhatsApp</a></li>
                        <li><a href="mailto:info@samhahfarm.com">Email</a></li>
                        <li><a href="#lokasi">Lokasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Samhah Farm. Hak Cipta Dilindungi. | "Sehat, Segar, dan Berkah"</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Smooth Scroll for Navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    // Close mobile menu
                    navLinks.classList.remove('active');
                    
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header Scroll Effect
        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Active Navigation Link
        const sections = document.querySelectorAll('section[id]');
        const navItems = document.querySelectorAll('.nav-links a');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
