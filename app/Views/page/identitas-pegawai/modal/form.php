<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--identitas__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Identitas Pegawai Baru</h1>
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
                            <label for="jenis_kelamin" class="col-form-label text-sm-end">Jenis Kelamin
                                <span class="text-danger">*</span>
                            </label>
                            <select id="jenis_kelamin" class="select2 form-select" data-allow-clear="true" name="jenis_kelamin">
                                <option disabled selected>Pilih</option>
                                <option disabled selected>P</option>
                                <option disabled selected>L</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3 select-box">
                            <label for="tempat_lahir" class="col-form-label text-sm-end">Tempat Lahir
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="tanggal_lahir" class="col-form-label text-sm-end">Tanggal Lahir
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" id="tanggal_lahir" class="form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="status_kepegawaian" class="col-form-label text-sm-end">Status Kepegawaian
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="status_kepegawaian" class="form-control" placeholder="Masukan Status Kepegawaian" name="status_kepegawaian">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="nip" class="col-form-label text-sm-end">NIP
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nip" class="form-control" placeholder="Masukan nip" name="nip">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="agama" class="col-form-label text-sm-end">Agama
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="agama" class="form-control" placeholder="Masukan Agama" name="agama">
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