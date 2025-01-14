<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--alamat__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Identitas Keterangan Jasmani Baru</h1>
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
                            <label for="nomor_induk" class="col-form-label text-sm-end">Nama Pegawai
                                <span class="text-danger">*</span>
                            </label>
                            <select id="nomor_induk" class="select2 form-select" data-allow-clear="true" name="nomor_induk">
                                <option disabled selected>Pilih</option>
                                <?php foreach($users as $user): ?>
                                    <?php if ($user['type_user'] == 'is_teacher'): ?>
                                        <option value="<?= $user['nomor_induk'] ?>"><?= $user['nama_lengkap'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="alamat_rumah" class="col-form-label text-sm-end">Alamat Rumah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="alamat_rumah" class="form-control" placeholder="Masukan Alamat Rumah" name="alamat_rumah">
                        </div>
                        <div class="col-md-12 mt-3 select-box">
                            <label for="status_rumah" class="col-form-label text-sm-end">Status Rumah
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="status_rumah" class="form-control" placeholder="Masukan Tempat Lahir" name="status_rumah">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="nomor_telephone" class="col-form-label text-sm-end">Nomor Telephone
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nomor_telephone" class="form-control" placeholder="Masukan Status Kepegawaian" name="nomor_telephone">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="jarak_kantor" class="col-form-label text-sm-end">Jarak ke Kantor
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="jarak_kantor" class="form-control" placeholder="Masukan Riwayat Penyakit" name="jarak_kantor">
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