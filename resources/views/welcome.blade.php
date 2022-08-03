<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontoffice/css/bootstrap.min.css') }}">
    <title>Sisstem Aplikasi Perpustakaan</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap');

        a {
            text-decoration: none;
            text-align: right !important;
        }

        body {
            font-family: "Playfair Display";
            background: url("/backoffice/img/smp.JPEG");
            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>

<body class="bg-success">

    <div class="container-fluid">
        <div class="row justify-content-md-between bg-white mb-4">
            <div class="col-lg-3 text-center">
                <img width="80px" src="/backoffice/img/tutwuri.png" alt="" srcset="">
            </div>
            <div class="col-lg-6 text-center mt-4">
                {{-- ini text berjalan --}}
                <marquee behavior="" direction="">

                    <h4 class="text-uppercase">Selamat Datang di Sistem Informasi Perpustakaan SMP Negeri 1 Lubuk
                        Sikaping
                    </h4>
                </marquee>
            </div>
            <div class="col-lg-3 text-center">
                <img width="80px" src="/backoffice/img/logo.jpg" alt="">
            </div>
        </div>
        <div class="row justify-content-between my-5">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-white text-center">
                        Menu
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @auth
                                <li class="list-group-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @else
                                <li class="list-group-item"><a href="{{ route('login') }}">Login</a></li>
                                <li class="list-group-item"><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                            <li class="list-group-item"><a href="/">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        {{-- tambahkan aturan disini --}}
                        <h3 class="text-center">TATA TERTIB PERPUSTAKAAN SMPN 1 LUBUK SIKAPING </h3>
                        <hr>
                        <h4>I SETIAP PENGUNJUNG PERPUSTAKAAN DIHARAPKAN </h4>
                        <ol>
                            <li>Setiap Pengunjung Perpustakaan diharapkan mengucapkan salam saat memasuki ruang
                                perpustakaan </li>
                            <li>Menitipkan tas dan barang bawaan lainnya pada tempat yang telah disediakan.</li>
                            <li>Setiap pengunjung harus memindahkan kartu pengunjung dari kotak kartu pengunjung ke
                                tonggak kartu pengunjung atau mengisi buku data penngunjung </li>
                            <li>Menjaga keutuhan, kerapian dan keselamatan koleksi, sarana dan fasilitas perpustakaan.
                            </li>
                            <li>Setiap pengunjung perpustakaan dilarang berbicara keras, menyanyi, tertawa dan bersenda
                                gurau yang mengganggu pengunjung lain dalam ruang perpustakaan </li>
                            <li>Tidak membawa rokok, makanan dan minuman kedalam ruang perpustakaan.</li>

                        </ol>
                        <h4>II. HAK DAN KEWAJIBAN ANGGOTA PERPUSTAKAAN </h4>
                        <ol>
                            <li> Anggota perpustakaan SMPN I Lubuk Sikaping adalah, Siswa/siswi, karyawan dan karyawati
                                SMPN 1 Lubuk Sikaping </li>
                            <li>Setiap siswa diwajibkan menggunakan koleksi dan fasilitas perpustakaan SMPN I Lubuk
                                Sikaping </li>
                            <li> Setiap siswa wajib memiliki kartu anggota perpustakaan </li>
                            <li> Anggota dan pengunjung perpustakaan berhak meminjam, membaca dan belajar mandiri di
                                perpustakaan </li>
                            <li>Dalam peminjaman dan pengembalian buku setiap anggota perpustakaan harus membawa kartu
                                anggota </li>
                            <li>Anggota di beri hak meminjam buku perpustakaan :
                                <br>
                                a. Peminjaman jangka panjang ( satu tahun)
                                b. Peminjaman jangka pendek (tiga hari)
                            </li>
                            <li>Maksimal peminjaman buku jangka pendek 3(tiga) eksemplar</li>
                            <li> Perpanjangan peminjaman japgka pendek dapat di perpanjang 2 (dua) kali peminjaman</li>
                            <li>Anggota atau pengunjung perpustakaan di perbolehkan meminjam koleksi untuk di fotocopy
                                setelah dapat izin kepala pustaka atau petugas pustaka SMP N 1 Lubuk Sikaping dengan
                                ketentuan :
                                <br>
                                a. Maksimal peminjaman 2 eksemplar
                                b. Meninggalkan kartu identitas atau kartu anggota perpustakaan
                            </li>
                        </ol>

                        <h4>
                            III JAM BUKA
                        </h4>
                        <p>Pagi</p>

                        <ol>
                            <li>Senin sampai kamis jam 7.30-12.30</li>
                            <li>Jumat jam 7.30-11.30</li>
                            <li>sabtu jam 7.30-11.00</li>
                        </ol>
                        <p>Siang</p>
                        <ol>
                            <li>Senin sampai kamis jam 12.45-17.15</li>
                            <li>Jumat jam 14.00-17.30</li>
                            <li>sabtu jam 11.0-15.00</li>
                        </ol>
                        <h4>IV SANKSI</h4>
                        <ol>
                            <li>
                                Setiap anggota atau pengunjung yang tidak mengindahkan tata tertib di kenakan sanksi
                                berupa teguran, tidak dipinjamkan buku atau dikeluarkan dari anggota perpustakaan SMPN 1
                                Lubuk Sikaping
                            </li>
                            <li>Setiap pengunjung yang merusak, menghilangkan koleksi dan fanilitas ruang perpustakaan
                                harus memperbaiki atau mengganti koleksi stau fasilitas tersebut</li>
                            <li>Anggota yang terlambat mengembalikan buku pinjaman dari batas yang ditentukan dikenakan
                                denda Rp. 2000,- (dua ribu Rupiah)</li>
                        </ol>
                        {{-- akhir aturan --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-white text-center">
                        Buku Terbaru
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($buku_terbaru as $item)
                                <li class="list-group-item">{{ $item->nama_buku }}</li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>

        <div class="bg-white">
            <div class="text-center p-3 mt-2">
                <p>Copyright &copy; 2022 Sistem Apilkasi Perpustakaan</p>

            </div>
        </div>
    </footer>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('frontoffice/js/jquery.3.6.0.js') }}"></script>
    <script src="{{ asset('frontoffice/js/bootstrap.min.js') }}"></script>



</body>

</html>
