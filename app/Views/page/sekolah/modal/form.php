<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--sekolah__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Pendaftaran Sekolah Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama_sekolah" class="col-form-label text-sm-end">Nama Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_sekolah" class="form-control" placeholder="Masukan Nama Sekolah" name="nama_sekolah">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label fornomor_statistik class="col-form-label text-sm-end">Nomor Statistik
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nomor_statistik" class="form-control" placeholder="Masukan Nomor Statistik" name="nomor_statistik">
                        </div>
                        <div class="col-md-12 mt-3 select-box">
                            <label for="status_sekolah" class="col-form-label text-sm-end">Status Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <select id="status_sekolah" class="select2 form-select" data-allow-clear="true" name="status_sekolah">
                                <option disabled selected>Pilih</option>
                                <option value="Terdaftar">Terdaftar</option>
                                <option value="Belum Terdaftar">Belum Terdaftar</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kelurahan" class="col-form-label text-sm-end">Kelurahan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kelurahan" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kecamatan" class="col-form-label text-sm-end">Kecamatan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kecamatan" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="kota" class="col-form-label text-sm-end">Kota
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kota" class="form-control" placeholder="Masukan Nama Kota" name="kota">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="provinsi" class="col-form-label text-sm-end">Provinsi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="provinsi" class="form-control" placeholder="Masukan Nama Provinsi" name="provinsi">
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