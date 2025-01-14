<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--jasmani__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <label for="berat_badan" class="col-form-label text-sm-end">Berat Bedan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="berat_badan" class="form-control" placeholder="Masukan Berat Badan" name="berat_badan">
                        </div>
                        <div class="col-md-12 mt-3 select-box">
                            <label for="tinggi_badan" class="col-form-label text-sm-end">Tinggi Badan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="tinggi_badan" class="form-control" placeholder="Masukan Tempat Lahir" name="tinggi_badan">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="golongan_darah" class="col-form-label text-sm-end">Golongan Darah
                                <span class="text-danger">*</span>
                            </label>
                            <select id="golongan_darah" class="select2 form-select" placeholder="Masukan Golongan Darah" name="golongan_darah">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="riwayat_penyakit" class="col-form-label text-sm-end">Riwayat Penyakit
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="riwayat_penyakit" class="form-control" placeholder="Masukan Riwayat Penyakit" name="riwayat_penyakit">
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