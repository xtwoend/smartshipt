@extends('layouts.dash')

@section('content')
<main class="content full">
    <a id="btn-toggle" href="#" class="sidebar-toggler break-point-lg">
        <i class="ri-menu-line ri-xl"></i>
    </a>
    <div class="page-body help">
        <div class="container ">
            <div class="row g-4">
                <div class="col-9">
                    <div class="item">
                        <div class="page-title">
                            Home
                        </div>
                        <div class="page-content">
                            Widget ini adalah peta sederhana. Secara default, peta menampilkan semua kapal Anda dan Anda dapat memilih untuk memfilternya. Detail kapal biasanya disembunyikan agar tidak mengacaukan tampilan. Jika diperlukan, detail kapal dapat dibuat terlihat dengan mengkliknya
                        </div>
                        <div class="page-image">
                            <img src="{{ asset('img/home.png') }}" alt="home">
                        </div>
                    </div>
                    <div class="item">
                        <div class="page-title">
                            Overview
                        </div>
                        <div class="page-content">
                            Halaman ini memberikan gambaran yang komprehensif tentang berbagai aspek performa kapal, mulai dari jarak tempuh, speed, hingga aktivitas di pelabuhan, yang dapat digunakan untuk mengambil keputusan yang lebih baik terkait operasi kapal.
                        </div>
                        <div class="page-image">
                            <img src="{{ asset('img/overview.png') }}" alt="home">
                        </div>
                    </div>
                    <div class="item">
                        <div class="page-title">
                            My Fleets
                        </div>
                        <div class="page-content">
                            Halaman <i>"My Fleets"</i> adalah platform yang menampilkan data lengkap mengenai kapal dari berbagai aspek seperti Navigasi, Main Engine, Generator, Pumps, Cargo Tank, Bunker Tank, Ballast Tank, alarm, dan oils. Untuk mengakses informasi terkait kapal-kapal tersebut, pengguna dapat memilih kapal yang diinginkan melalui dropdown menu yang tersedia di menu navigasi pada sebelah kiri tampilan. Setelah memilih kapal, pengguna akan diarahkan ke halaman <i>"My Fleets"</i> yang menampilkan detail-detail tersebut.
                        </div>
                        <div class="page-image">
                            <img src="{{ asset('img/myfleets.png') }}" height="380" alt="home">
                        </div>
                    </div>
                    <div class="item">
                        <div class="page-title">
                            Fleet Master Data
                        </div>
                        <div class="page-content">
                            Halaman ini adalah database yang mencakup informasi tentang armada kapal, termasuk daftar kapal, detail teknis, dan informasi terkait kapal-kapal tersebut. Kemudian di kolom paling kanan dari informasi kapal tersebut, terdapat tindakan <i>"View Data"</i> yang memungkinkan pengguna untuk membuka informasi lebih detail terkait kapal tersebut
                        </div>
                        <div class="page-image">
                            <img src="{{ asset('img/data-master.png') }}" alt="home">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    list
                </div>
            </div>
        </div>
    </div>
</main>
@endsection