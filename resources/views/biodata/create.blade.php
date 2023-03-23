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
                            <h5 class="content-header-title float-left pr-1 mb-0">Biodata</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/biodata">Biodata</a>
                                    </li>
                                    <li class="breadcrumb-item active">User Baru
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
                                    <h4 class="card-title">Biodata</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="form-tambah-edit" name="form-tambah-edit">
                                            <input type="hidden" id="id" name="id">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <fieldset class="form-group">
                                                        <label for="name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="" required>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="telp">No Telp</label>
                                                        <input type="number" class="form-control" id="telp"
                                                            name="telp" placeholder="" required>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="sex">Jenis Kelamin</label>
                                                        <select class="form-control" name="sex" id="sex" required>
                                                            <option value="">- Pilih Gender -</option>
                                                            <option value="L">Laki - laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </fieldset>

                                                    <fieldset class="form-group">
                                                        <label for="community_id">Asal Komunitas</label>
                                                        <select class="form-control" name="community_id" id="community_id"
                                                            required>
                                                            <option value="">- Pilih Gender -</option>
                                                            <option value="1">SAS</option>
                                                        </select>
                                                    </fieldset>
                                                    <button type="submit" style="float: right"
                                                        class="btn btn-outline-primary" id="tombol-simpan"
                                                        value="create">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
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
@endsection

@push('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        // ** CSRF Token * //
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });


        // ** TAMBAH DATA BARU * //
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function(form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Menyimpan . .');
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('biodata/store') }}",
                        data: $('#form-tambah-edit').serializeArray(),
                        dataType: 'json',
                        success: function(data) {
                            toastr.success('Selamat!', 'Data Anda telah tersimpan');
                            window.location.replace("{{ URL::to('/') }}");
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
