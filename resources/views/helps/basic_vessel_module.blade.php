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
                            Ship Info
                        </div>
                        <div class="page-content">
                            Halaman Ship Info menunjukkan berbagai pilihan informasi yang diterima dalam paket data terakhir yang diterima dari kapal, dikelompokkan ke dalam beberapa kategori seperti IMO number, Ship Owner, Ship Manager, and Other basic information of the ship
                        </div>
                        <div class="page-image">
                            <img src="{{ asset('img/home.png') }}" alt="home">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection