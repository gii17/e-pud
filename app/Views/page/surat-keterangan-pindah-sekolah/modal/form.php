<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--surat-keterangan-pindah-sekolah__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Keterangan Pindah Sekolah </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <span class="text-md font-weight-bold">Yang bertanda tangan dibawah ini : </span><br>
                <span class="mb-2 text-xs">Nama : <span class="text-dark font-weight-bold ms-sm-2" id="nama_orang_tua"></span></span>
                <br>
                <span class="mb-2 text-xs">Pekerjaan: <span class="text-dark font-weight-bold ms-sm-2" id="pekerjaan"></span></span><br>
                <span class="mb-2 text-xs">Alamat: <span class="text-dark font-weight-bold ms-sm-2" id="alamat"></span></span><br><br>

                <span class="text-md font-weight-bold">Yang bertanda tangan dibawah ini : </span><br>
                <span class="mb-2 text-xs">Nama: <span class="text-dark font-weight-bold ms-sm-2" id="nama_siswa"></span></span><br>
                <span class="mb-2 text-xs">Tempat Tanggal Lahir: <span class="text-dark font-weight-bold ms-sm-2" id="tempat_tanggal_lahir"></span></span>
                <br>
                <span class="mb-2 text-xs">Nomor Induk: <span class="text-dark font-weight-bold ms-sm-2" id="nomor_induk"></span></span>
                <br>
                <span class="mb-2 text-xs">Jenis Kelamin: <span class="text-dark font-weight-bold ms-sm-2" id="jenis_kelamin"></span></span>
                <br>
                <span class="mb-2 text-xs">Siswa Kelompok: <span class="text-dark font-weight-bold ms-sm-2" id="kelompok_siswa"></span></span>
                <br>

                <form method="post" class="mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama_kb" class="col-form-label text-sm-end">Nama Kelompok Belajar (KB)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_kb" class="form-control" placeholder="Masukan Nama Kelompok Belajar" name="nama_kb">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="status_sekolah" class="col-form-label text-sm-end">Status Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="status_sekolah" class="form-control" placeholder="Masukan Status Sekolah" name="status_sekolah">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="alamat_sekolah" class="col-form-label text-sm-end">Alamat
                                <span class="text-danger">*</span>
                            </label>
                            <textarea id="alamat_sekolah" class="form-control" placeholder="Masukan Alamat" name="alamat_sekolah"></textarea>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="provinsi" class="col-form-label text-sm-end">Provinsi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="provinsi" class="form-control" placeholder="Masukan Provinsi" name="provinsi">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kota" class="col-form-label text-sm-end">Kota
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kota" class="form-control" placeholder="Masukan Kota" name="kota">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kecamatan" class="col-form-label text-sm-end">Kecamatan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kecamatan" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kelurahan" class="col-form-label text-sm-end">Kelurahan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kelurahan" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="tanggal_diterima" class="col-form-label text-sm-end">Tanggal Diterima
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" id="tanggal_diterima" class="form-control flatpickr" placeholder="Masukan Tanggal Diterima" name="tanggal_diterima">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn__save">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/library/libs/jquery/jquery.js')?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/library/libs/select2/select2.css') ?>"/>
<link rel="stylesheet" href="<?= base_url('assets/library/libs/flatpickr/flatpickr.css') ?>"/>
<script src="<?= base_url('assets/library/libs/select2/select2.js') ?>"></script>
<script src="<?= base_url('assets/library/libs/flatpickr/flatpickr.js') ?>"></script>

<script>
    $('.select2').select2({
        dropdownParent: $('.select-box'),
        allowClear: true
    });

    $(".flatpickr").flatpickr({
        monthSelectorType: 'static'
    });
</script>