@extends('layouts.main')

@section('title', 'Dashboard')

@section('container')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Katalog</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"></a>
                                    </li>
                                    <li class="breadcrumb-item active">Katalog
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
                                <div class="card-header">
                                    <h4 class="card-title">Katalog</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" class="mb-2 btn btn-border btn-primary"
                                            id="add-btn"><i class="bx bx-plus"></i> Tambah Data</a>
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <td>No</td>
                                                        <td>SKU</td>
                                                        <td>Nama</td>
                                                        <td>Desikrpsi</td>
                                                        <td>Status</td>
                                                        <td>Total Gambar</td>
                                                        <td>Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
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
    <div class="modal fade" id="modal-crud" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
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
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <label for="name">Kode SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" placeholder=""
                                        required>
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="telp">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder=""
                                        required>
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="telp">Deskripsi Produk</label>
                                    <textarea class="form-control" name="description" id="editor" cols="100" rows="8"></textarea>
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="telp">Gambar Produk</label>
                                    <input type="file" class="form-control" name="images[]" multiple>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
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

            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ URL::to('master/katalog') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active'
                        },
                        {
                            data: 'images_count',
                            name: 'images_count'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });
            });
        });

        $("#add-btn").click(function() {
            $("#modal-crud").modal('show');
            $("#modal-title").html('Tambah Data Katalog');
            $('#form-tambah-edit').trigger("reset");            
        });


        // ** TAMBAH DATA BARU * //
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function(form) {
                    var actionType = $('#tombol-simpan').val();
                    var formData = new FormData(form);
                    $('#tombol-simpan').html('Menyimpan . .');
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('master/katalog/simpan') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(data) {
                            toastr.success('Selamat!', 'Data Anda telah tersimpan');
                            $('#form-tambah-edit').trigger("reset");
                            $("#modal-crud").modal('hide');
                            $('#myTable').DataTable().ajax.reload();

                        },
                        error: function(data) {
                            console.log('Error', data);
                            toastr.error('Gagal!', 'Data Anda gagal tersimpan ');
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            });
        }

        function editData(id) {
            // console.log(id);
            $.get("{{ URL::to('/master/katalog/detil') }}/" + id, function(data) {
                console.log(data.sku);
                $("#modal-crud").modal('show');
                $("#modal-title").html('Edit data Katalog: ' + data.sku);
                $("#id").val(data.id);
                $("#sku").val(data.sku);
                $("#nama").val(data.name);
                $("textarea#editor").val(data.description);
                YourEditor.setData(data.description);
            });

        }
    </script>
@endpush
