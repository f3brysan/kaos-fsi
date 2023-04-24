@extends('layouts.main')

@section('title', 'Shop')

@section('container')
    <style>
        .events {
            height: 300px;
            display: flex;
            justify-content: center;
            overflow: hidden;

        }

        .events img {
            width: 90%;
            margin: auto;
            display: block;
            overflow: hidden;
        }
    </style>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Shop</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"></a>
                                    </li>
                                    <li class="breadcrumb-item active">Shop
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- BODY START -->
                <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Pesananku</h4>
                                        <div class="table-responsive">
                                            <form action="/keranjangku/checkout" method="POST" >
                                                @csrf
                                            <button type="submit" class="mr-3 btn btn-primary disabled" id="trans-selected-btn"
                                            style="float: right"><i class="fa fa-check"></i>Tidak ada yg terpilih</button>
                                            <table class="table table-responsive zero-configuration" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Pilih</th>
                                                        <th class="text-center">Gambar</th>
                                                        <th class="text-center">Nama Item</th>
                                                        <th class="text-center">Size/Harga</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-center">Total Harga</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                    @if ($list)
                                                        @foreach ($list as $item)
                                                            <tr>
                                                                <td class="text-center">`
                                                                    <input class="check list-check" id="check" type="checkbox" name="check[]"
                                                                        value="{{ $item->id }}" id="checkbox[]">
                                                                </td>
                                                                <td class="text-center"><img
                                                                        src="{{ URL::to($item['katalog']['images'][0]['name']) }}"
                                                                        alt="{{ $item->katalog->name }}"
                                                                        class="img-thumbnail" width="100px"></td>
                                                                <td class="text-center">{{ $item->katalog->name }}</td>
                                                                <td class="text-center"><span
                                                                        class="badge badge-secondary">Size
                                                                        : {{ $item->hargasize->size }} </span> <br>Rp.
                                                                    {{ number_format($item->hargasize->s_price, 2, '.', ',') }}/pcs
                                                                </td>
                                                                <td class="text-center">{{ $item->qty }} pcs</td>
                                                                <td class="text-center">Rp.
                                                                    {{ number_format($item->hargasize->s_price * $item->qty, 2, '.', ',') }}
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="editPesanan('{{ Crypt::encrypt($item->id) }}')"
                                                                        class="btn btn-warning" title="Ubah Pesanan"><i
                                                                            class="bx bx-edit-alt"></i></a>
                                                                    &nbsp;
                                                                    <a href="" class="btn btn-danger"
                                                                        title="Hapus Pesanan"><i
                                                                            class="bx bx-trash-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <span class="badge badge-danger">Anda belum memesan item
                                                            apapun!</span>
                                                    @endif
                                                </tbody>
                                            </form>
                                            </table>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- BODY END -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-pesanan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-tambah-edit" name="form-tambah-edit" enctype="multipart/form-data" method="post"
                    action="/keranjangku/store-item">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="catalogues_id" id="catalogues_id">                
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="name">Size</label>
                                    <input class="form-control order" type="text" name="size" id="size" readonly>                                   
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="telp">Kuantitas</label>
                                    <input type="number" class="form-control order" id="qty" name="qty"
                                        placeholder="" required>
                                </fieldset>
                            </div>
                        </div>
                        <div>
                            <p id="total-harga">Rp 0,-</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="simpan-order" class="btn btn-sm btn-primary">Masukan keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('custom-js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let YourEditor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                window.editor = editor;
                YourEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <script>
        // ** CSRF Token * //
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function editPesanan(id) {
            console.log(id);
            $("#modal-pesanan").modal('show');
            $.get("{{ URL::to('/keranjangku/detil-item/') }}/" + id,
                function(data) {
                    console.log(data);
                    $("#modal-title").html(data.katalog.name + " Size : " + data.hargasize.size);
                    $("#id").val(data.id);
                    $("#size").val(data.hargasize.id).change();
                    $("#qty").val(data.qty);
                    $("#catalogues_id").val(data.catalogue_id);
                    var qty = $("#qty").val();
                    var harga = data.hargasize.s_price;
                    var total = parseInt(qty) * parseInt(harga);
                    var reverse = total.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    var ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#total-harga").html("Rp " + ribuan).change();
                    $(".order").on("keyup change", function() {
                        var harga = data.hargasize.s_price;
                        console.log(harga);
                        var qty = $("#qty").val();
                        let rupiah = Intl.NumberFormat('en-ID');
                        var total = parseInt(qty) * parseInt(harga);
                        var reverse = total.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        var ribuan = ribuan.join('.').split('').reverse().join('');
                        $("#total-harga").html("Rp " + ribuan).change();
                    });
                });
        }

        $("body").on('change', '.check', function() {
                var numberOfChecked = $('.list-check:checked').length;
                var countChecked = $('.list-check').length
                console.log(numberOfChecked, countChecked);

                if (numberOfChecked == countChecked) {
                    $('#checkAll').prop('checked', true); // Checks it
                } else {
                    $('#checkAll').prop('checked', false); // Unchecks it
                }

                if (numberOfChecked < 1) {
                    var numberOfChecked = "Tidak ada yg";
                    $("#trans-selected-btn").addClass('disabled');
                } else {
                    var numberOfChecked = numberOfChecked;
                    $("#trans-selected-btn").removeClass('disabled');
                }

                $("#trans-selected-btn").html(numberOfChecked + " terpilih");
            });
    </script>
@endpush
