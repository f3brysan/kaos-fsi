@extends('layouts.main')

@section('title', 'Master Size')

@section('container')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Master Size</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"></a>
                                    </li>
                                    <li class="breadcrumb-item active">Master Size
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
                                    <h4 class="card-title">Master Size</h4>
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
                                                        <td>Size</td>
                                                        <td>Harga Pokok</td>
                                                        <td>Harga Jual</td>
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
                                    <label for="name">Size</label>
                                    <input type="text" class="form-control" id="size" name="size" placeholder=""
                                        required>
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="telp">Harga Pokok</label>
                                    <input type="text" class="form-control uang" id="b_price" name="b_price" placeholder=""
                                        required>
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="telp">Harga Jual</label>
                                    <input type="text" class="form-control uang" id="s_price" name="s_price" placeholder=""
                                        required>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
        integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
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

            $( '.uang' ).mask('000.000.000.000', {reverse: true});

            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ URL::to('master/size') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: 'b_price',
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                            name: 'b_price'
                        },
                        {
                            data: 's_price',
                            render: $.fn.dataTable.render.number(',', '.', 2, 'Rp '),
                            name: 's_price'
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
            YourEditor.setData("");

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
                        url: "{{ URL::to('master/size/simpan') }}",
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
