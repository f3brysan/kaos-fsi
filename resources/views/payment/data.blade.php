@extends('layouts.main')

@section('title', 'Data Pemesanan')

@section('container')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Data Pemesanan</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ URL::to('') }}"><i
                                                class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Data Pemesanan
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Description -->
                <section id="description" class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pemesanan</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab-center" data-toggle="tab"
                                                    href="#home-center" aria-controls="home-center" role="tab"
                                                    aria-selected="true">
                                                    Belum Dibayar
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="service-tab-center" data-toggle="tab"
                                                    href="#service-center" aria-controls="service-center" role="tab"
                                                    aria-selected="false">
                                                    Sudah Dibayar/Menunggu Verifikasi
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="account-tab-center" data-toggle="tab"
                                                    href="#account-center" aria-controls="account-center" role="tab"
                                                    aria-selected="false">
                                                    Telah Diverifikasi
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home-center" aria-labelledby="home-tab-center"
                                                role="tabpanel">
                                                <h6>Transaksi Belum Dibayar</h6>
                                                <br>
                                                <div class="table-responsive">
                                                    <table
                                                        class="display nowrap table-striped table-bordered table float-center"
                                                        style="width:100%" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 3%">No</th>
                                                                <th class="text-center" style="width: 7%">No Pesanan</th>
                                                                <th class="text-center">Total Pembayaran</th>
                                                                <th class="text-center">Detil Barang</th>
                                                                <th class="text-center">Pemilik</th>
                                                                <th class="text-center" style="width: 7%">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($unpaid as $item)
                                                                <tr>
                                                                    <td class="text-right">{{ $loop->iteration }}</td>
                                                                    <td class="text-center">{{ $item->no_pesanan }}</td>
                                                                    <td class="text-right">Rp.
                                                                        {{ number_format($item->total_biaya, 2, '.', ',') }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($item->items as $barang)
                                                                            <li>
                                                                                {{ $barang->katalog->name }}
                                                                                ({{ $barang->hargasize->size }})
                                                                                -
                                                                                {{ $barang->qty }}
                                                                                pcs
                                                                            </li>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $item->biodata->name }}</td>
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-info"
                                                                            onclick="detailOrder('{{ Crypt::encrypt($item->id) }}')">
                                                                            Check</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="service-center" aria-labelledby="service-tab-center"
                                                role="tabpanel">
                                                <h6>Menunggu Verifikasi</h6>
                                                <br>
                                                <table
                                                    class="display nowrap table-striped table-bordered table float-center"
                                                    style="width:100%" id="table2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 3%">No</th>
                                                            <th class="text-center" style="width: 7%">No Pesanan</th>
                                                            <th class="text-center">Total Pembayaran</th>
                                                            <th class="text-center">Detil Barang</th>
                                                            <th class="text-center">Pemilik</th>
                                                            <th class="text-center" style="width: 7%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($waiting as $item)
                                                            <tr>
                                                                <td class="text-right">{{ $loop->iteration }}</td>
                                                                <td class="text-center">{{ $item->no_pesanan }}</td>
                                                                <td class="text-right">Rp.
                                                                    {{ number_format($item->total_biaya, 2, '.', ',') }}
                                                                </td>
                                                                <td>
                                                                    @foreach ($item->items as $barang)
                                                                        <li>
                                                                            {{ $barang->katalog->name }}
                                                                            ({{ $barang->hargasize->size }})
                                                                            <a class="float-right"> {{ $barang->qty }}
                                                                                pcs </a>
                                                                        </li>
                                                                    @endforeach
                                                                </td>
                                                                <td>{{ $item->biodata->name }}</td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)" class="btn btn-sm btn-info"
                                                                        onclick="detailOrder('{{ Crypt::encrypt($item->id) }}')">
                                                                        Check</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="account-center" aria-labelledby="account-tab-center"
                                                role="tabpanel">
                                                <h6>Telah Diverifikasi</h6>
                                                <br>
                                                <table
                                                    class="display nowrap table-striped table-bordered table float-center"
                                                    style="width:100%" id="table2">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 3%">No</th>
                                                            <th class="text-center" style="width: 7%">No Pesanan</th>
                                                            <th class="text-center">Total Pembayaran</th>
                                                            <th class="text-center">Detil Barang</th>
                                                            <th class="text-center">Pemilik</th>
                                                            <th class="text-center" style="width: 7%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($valid) > 0)
                                                            @foreach ($valid as $item)
                                                                <tr>
                                                                    <td class="text-right">{{ $loop->iteration }}</td>
                                                                    <td class="text-center">{{ $item->no_pesanan }}</td>
                                                                    <td class="text-right">Rp.
                                                                        {{ number_format($item->total_biaya, 2, '.', ',') }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($item->items as $barang)
                                                                            <li>
                                                                                {{ $barang->katalog->name }}
                                                                                ({{ $barang->hargasize->size }})
                                                                                <a class="float-right">
                                                                                    {{ $barang->qty }}
                                                                                    pcs </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $item->biodata->name }}</td>
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-info"
                                                                            onclick="detailOrder('{{ Crypt::encrypt($item->id) }}')">
                                                                            Check</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <td class="text-center" colspan="5"><span
                                                                    class="badge badge-warning">Belum ada transaksi
                                                                    !</span></td>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="modal-unpaid" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-unpaid-title">Detil Pesanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>No Pesanan : </span>
                            <strong>
                                <p class="text-left" id="judul-unpaid"></p>
                            </strong>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Status : </span><br>
                            <strong>
                                <p class="text-left" id="status-unpaid"> Menunggu Upload Bukti Pembayaran</p>
                            </strong>
                        </div>
                        <div class="col-md-6">
                            <span>Tanggal Pemesanan : </span><br>
                            <strong>
                                <p class="text-left" id="date-unpaid"> </p>
                            </strong>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Detil Pembelian</h6>
                            <span>Detil Barang : </span>
                            <br>
                            <span id="detil-barang"></span>
                            <br>
                            <span id="detil-ongkir">Ongkos Kirim </span>
                            <span class="float-right" id="detil-ongkir-biaya">sekian</span>
                            <br>
                            <br>
                            <span id="detil-pengiriman"></span>
                            <br>
                            <span><b>Total Pembayaran : </b></span>
                            <span id="total-pembayaran" class="float-right"></span>
                        </div>
                    </div>
                    <hr>
                    <form enctype="multipart/form-data" id="unggah-bukti-pembayaran" name="unggah-bukti-pembayaran">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="id-unpaid">
                            <div class="col-md-12" id="input-file">
                                <h6>Unggah Bukti Pembayaran</h6>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        name="document" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-12" id="file-uploaded">
                                <label for=""> Lihat Bukti Pembayaran</label>
                                <a href="javascript:void(0)" id="view-file" class="btn btn-block btn-info"> Lihat Bukti
                                    Bayar</a>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-outline-primary" id="tombol-simpan"
                        value="create">Simpan</button>
                    <a href="javascript:void(0)" class="btn btn-outline-primary" id="tombol-confirm">Konfirmasi</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @push('custom-js')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
            integrity="sha512-0QDLUJ0ILnknsQdYYjG7v2j8wERkKufvjBNmng/EdR/s/SE7X8cQ9y0+wMzuQT0lfXQ/NhG+zhmHNOWTUS3kMA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // ** CSRF Token * //
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.validator.addMethod('filesize', function(value, element, param) {
                        return this.optional(element) || (element.files[0].size <= param)
                    },
                    'Ukuran dokumen terlalu besar'); // notifikasi apabila file > 2mb

            });
        </script>

        <script>
            function detailOrder(id) {

                $.get("{{ URL::To('transaksi/unpaid') }}/" + id, function(data) {
                    $("#detil-barang").empty();
                    console.log(data);
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: false
                    };
                    const locale = 'id-ID';
                    var date = new Date(data.created_at);
                    var date = date.toLocaleString(locale, options);

                    var ongkir = parseInt(data.biaya_ongkir);
                    var ongkir = ongkir.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });

                    // start loop detil item
                    $.each(data.items, function(data, item) {
                        var number = parseInt(item.hargasize.s_price * item.qty);
                        var currency = number.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        });

                        $("#detil-barang").append('<li>' + item.katalog.name + ' (' + item.hargasize.size +
                            ') ' + item.qty + ' pcs. <span class="float-right">' + currency +
                            '</span> </li>');
                    });
                    // end loop detil item

                    $("#detil-ongkir").html("<b>Jenis Pengiriman</b> : " + data.kurir + "<br> Berat Barang : " + data
                        .bobot + " gram.");
                    $("#detil-pengiriman").html("<b>Alamat Pengiriman</b> : <br>" + data.alamat_tujuan + ",<br>" + data
                        .kab_tujuan + ", " + data.prov_tujuan);

                    var pembayaran = parseInt(data.total_biaya);
                    var pembayaran = pembayaran.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });

                    if (data.bukti_upload) {
                        $("#input-file").hide();
                        $("#file-uploaded").show();
                        $("#view-file").click(function() {
                            window.open(data.bukti_upload, '_blank');
                        });
                        $("#tombol-simpan").hide();
                        $("#status-unpaid").html('Menunggu Verifikasi Admin');
                        $("#tombol-confirm").show();
                    } else {
                        $("#input-file").show();
                        $("#status-unpaid").html('Menunggu Upload Bukti Pembayaran');
                        $("#file-uploaded").hide();
                        $("#tombol-simpan").show();
                        $("#tombol-confirm").hide();
                    }
                    $("#total-pembayaran").html(pembayaran);
                    $("#detil-ongkir-biaya").html(ongkir);
                    $("#modal-unpaid").modal('show');
                    $("#judul-unpaid").html(data.no_pesanan);
                    $("#date-unpaid").html(date);
                    $("#id-unpaid").val(data.id);

                    $("#tombol-confirm").click(function() {
                        Swal.fire({
                            title: 'Apakah Anda mengkonfirmasi pembayaran Sdr '+ data.biodata.name +' ?',
                            icon: 'question',
                            showDenyButton: true,
                            confirmButtonText: 'Iya',
                            denyButtonText: `Tidak, kembali`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                Swal.fire('Terkonfirmasi', '', 'success')
                                $('#modal-unpaid').modal("hide");
                                window.location.href = "/master/transaksi/approve/"+data.id;
                            } else if (result.isDenied) {
                                Swal.fire('Perubahan tidak disimpan', '', 'info')
                                $('#modal-unpaid').modal("hide");
                            }
                        })
                    });
                });
            }

            if ($("#unggah-bukti-pembayaran").length > 0) {
                $("#unggah-bukti-pembayaran").validate({
                    // validasi mime type
                    rules: {
                        document: {
                            required: true, // wajib
                            extension: "jpg|jpeg|JPG|JPEG", // ekstensi JPG*
                            filesize: 2097152, // ukuran file < 2mb

                        }
                    },
                    messages: {
                        document: {
                            required: "Tidak Boleh Kosong",
                            extension: "Mohon mengunggah dokumen berekstensi *jpg/jpeg"
                        }
                    },
                    submitHandler: function(form) {
                        var actionType = $('#tombol-simpan').val();
                        var formData = new FormData(form);
                        $('#tombol-simpan').html('Menyimpan . .');
                        $.ajax({
                            type: "POST",
                            url: "/transaksi/unggah_pembayaran",
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) {

                                $('#unggah-bukti-pembayaran').trigger("reset");
                                $('#modal-unpaid').modal("hide");
                                $('#tombol-simpan').html('Simpan');
                                //Reload Total Finansial Planing
                                // swal("Berhasil", "Berkas telah tersimpan",
                                //     "success");
                                window.location.href = "/transaksi";
                            },
                            error: function(data) {
                                console.log('Error', data);
                                $('#tombol-simpan').html('Simpan');
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
