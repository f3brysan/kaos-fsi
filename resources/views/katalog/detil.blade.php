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
                                        <h4 class="card-title">{{ $data->name }}</h4>
                                        <h6 class="card-subtitle">{{ date_format($data->created_at, 'd-m-Y') }}</h6>
                                    </div>
                                    <div id="carousel-example-card" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner rounded-0" role="listbox">
                                            @foreach ($data->images as $img)
                                                @if ($loop->first)
                                                    <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                @endif
                                                <img src="{{ URL::to($img->name) }}"
                                                    class=" h-400 w-80 mx-auto d-block img-center" alt="First slide"
                                                    style="width: 400px">
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-example-card" role="button"
                                        data-slide="prev">
                                        <span class="bx bx-chevron-left icon-prev" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-example-card" role="button"
                                        data-slide="next">
                                        <span class="bx bx-chevron-right icon-next" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>{{ $data->name }}</strong>
                                    </p>
                                    <p class="card-text">
                                        {!! $data->description !!}
                                    </p>
                                    <a href="javascript:void(0)"
                                        class="mb-5  btn btn-success btn-glow float-right btn-order">Order</a>
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
    <div class="modal fade" id="modal-crud" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-tambah-edit" name="form-tambah-edit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group">
                                    <label for="name">Size</label>
                                    <select class="form-control order" name="size" id="size">
                                        <option value="">Pilih Size</option>
                                        @foreach ($size as $size)
                                            <option value="{{ $size->s_price }}">{{ $size->size }}</option>
                                        @endforeach
                                    </select>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="simpan-order" class="btn btn-primary">Masukan keranjang</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
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
        $(document).ready(function() {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin: 10,
                nav: true,
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        })
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

        $(".btn-order").click(function() {
            $("#modal-crud").modal('show');
            $("#modal-title").html('Tambah ke Keranjang');
            $('#form-tambah-edit').trigger("reset");
        });

        $(".order").on("keyup change", function () {                  
                var harga = $("#size").val();
                var qty = $("#qty").val();
                let rupiah = Intl.NumberFormat('en-ID');
                var total = parseInt(qty) * parseInt(harga);
                var reverse = total.toString().split('').reverse().join(''),
                  ribuan = reverse.match(/\d{1,3}/g);
                var ribuan = ribuan.join('.').split('').reverse().join('');                                                     
            $("#total-harga").html("Rp " + ribuan).change();
                console.log(harga, qty);
        });
    </script>
@endpush
