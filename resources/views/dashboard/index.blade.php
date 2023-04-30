@extends('layouts.main')

@section('title', 'Dashboard')

@section('container')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row">
                       
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Produk Katalog</div>
                                            <h3 class="mb-0">{{ $catalogue }} Produk</h3>
                                            <a href="{{ URL::to('katalog') }}" class="btn btn-info btn-block mt-1"> Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Keranjangku</div>
                                            <h3 class="mb-0">{{ $myCart }} pcs</h3>
                                            <a href="{{ URL::to('keranjangku') }}" class="btn btn-info btn-block mt-1"> Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Pembelianku</div>
                                            <h3 class="mb-0">{{ $myOrder }} pcs</h3>
                                            <a href="{{ URL::to('transaksi') }}" class="btn btn-info btn-block mt-1"> Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                </section>
                <!-- Dashboard Analytics end -->
            </div>
        </div>
    </div>
@endsection
