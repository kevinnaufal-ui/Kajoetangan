<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kajoetangan')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800,900&display=swap">
    <style>
        * {
            box-sizing: border-box;
        }
        body { 
            background: #fbeee7; 
            font-family: 'Montserrat', Arial, sans-serif; 
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Navbar */
        .navbar-wrapper {
            display: flex;
            justify-content: flex-end;
            padding: 12px 60px 12px 40px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar {
            background: #5a2600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            border-radius: 32px;
            box-shadow: 0 4px 20px rgba(90, 38, 0, 0.25);
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 12px 24px;
            border-radius: 26px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .navbar a:hover {
            background: rgba(160, 74, 26, 0.5);
        }
        .navbar a.active {
            background: #a04a1a;
        }
        
        /* Container */
        .container { 
            max-width: 1300px; 
            margin: 0 auto; 
            padding: 24px 24px;
            flex: 1;
        }
        
        /* Footer */
        .footer {
            background: #3d1a00;
            color: #fff;
            margin-top: auto;
        }
        .footer-main {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px 20px 32px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
        }
        .footer-brand {
            font-size: 1.5rem;
            font-weight: 900;
            font-style: italic;
            letter-spacing: 1px;
        }
        .footer-center {
            text-align: center;
        }
        .footer-center h4 {
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0 0 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-links {
            font-size: 0.85rem;
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
        }
        .footer-links a {
            color: #fff;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .footer-links a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
        .footer-links span {
            opacity: 0.6;
        }
        .footer-right {
            text-align: right;
        }
        .footer-right h4 {
            font-size: 0.9rem;
            font-weight: 700;
            margin: 0 0 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-social {
            display: flex;
            gap: 16px;
            justify-content: flex-end;
        }
        .footer-social a {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .footer-social a:hover {
            transform: scale(1.1);
        }
        .footer-social svg {
            width: 24px;
            height: 24px;
            fill: #fff;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.15);
            padding: 16px 20px;
            text-align: center;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 2px;
                padding: 8px;
            }
            .navbar a {
                font-size: 0.75rem;
                padding: 8px 14px;
            }
            .footer-main {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 24px;
            }
            .footer-right {
                text-align: center;
            }
            .footer-social {
                justify-content: center;
            }
        }
    </style>
    @yield('head')
</head>
<body>
    <div class="navbar-wrapper">
        <nav class="navbar">
            <a href="/" class="@if(request()->is('/')) active @endif">BERANDA</a>
            <a href="/galeri" class="@if(request()->is('galeri*')) active @endif">GALERI</a>
            <a href="/acara" class="@if(request()->is('acara')) active @endif">ACARA</a>
            <a href="/tentang" class="@if(request()->is('tentang')) active @endif">TENTANG</a>
            <a href="/pesan-tiket" class="@if(request()->is('pesan-tiket')) active @endif">PESAN TIKET</a>
        </nav>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-brand">KAJOETANGAN</div>
            <div class="footer-center">
                <h4>TENTANG KAMI</h4>
                <div class="footer-links">
                    <a href="/">BERANDA</a>
                    <span>/</span>
                    <a href="/galeri">GALERI</a>
                    <span>/</span>
                    <a href="/acara">ACARA</a>
                    <span>/</span>
                    <a href="/tentang">TENTANG</a>
                </div>
            </div>
            <div class="footer-right">
                <h4>IKUTI KAMI</h4>
                <div class="footer-social">
                    <a href="#" title="Instagram">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" title="Facebook">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">KAJOETANGAN ©2025</div>
    </footer>
</body>
</html>
