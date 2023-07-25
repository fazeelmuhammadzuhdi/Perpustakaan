<!DOCTYPE html>
<html lang="Pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/landing-page.css') }}">
    <title>Sistem Informasi Perpustakaan</title>
</head>

<body>
    <header>
        <nav class="navigation">
            <a href="{{ route('landingpage') }}" class="logo">SMP<span> N </span>1 Nan<span> Sabaris</span></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('landingpage') }}">Home</a></li>
                <i class='bx bx-search'></i>
            </ul>
            <div class="menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>
    <main>
        <section class="home">
            <div class="home-text">
                <h4 class="text-h4">Selamat Datang Di</h4>
                <h6 class="text-h1">Sistem Informasi Perpustakaan SMP 1 Nan Sabaris</h6>
                <p>Kami menyediakan berbagai layanan
                    perpustakaan untuk mendukung kebutuhan belajar dan pengetahuan Anda. Temukan koleksi buku, majalah,
                    dan sumber informasi lainnya untuk memperluas wawasan Anda.Mari bergabung dengan kami dalam
                    menjelajahi dunia pengetahuan dan membaca buku-buku inspiratif.</p>
                <a href="{{ route('login') }}" class="home-btn">Login</a>
            </div>
            <div class="home-img">
                <img src="{{ asset('adminlte/dist/img/buku.jpg') }}" alt="Buku">
            </div>
        </section>
    </main>
</body>

</html>
