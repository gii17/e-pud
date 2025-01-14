<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--tata-tertib__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Buat Tata Tertib Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="col-md-12">
                        <label for="judul_tata_tertib" class="col-form-label text-sm-end">Judul Tata Tertib
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="judul_tata_tertib" class="form-control" placeholder="Masukan Judul Tata Tertib" name="judul" required>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="teacher_id" class="col-form-label text-sm-end">Daftar Aturan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="row d-flex align-items-center" id="daftar_aturan">

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
<script src="<?= base_url('assets/library/libs/select2/select2.js') ?>"></script>

<script>

</script>