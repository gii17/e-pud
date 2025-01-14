<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--jadwal__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content px-1">
            <div class="modal-header pb-0">
                <h1 class="modal-title fs-5">Tambah Jadwal Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6 select-box">
                            <label for="hari" class="col-form-label text-sm-end">Hari
                                <span class="text-danger">*</span>
                            </label>
                            <select id="hari" class="select2 form-select" data-allow-clear="true" name="hari">
                                <option disabled selected>Pilih</option>
                                <option value="SENIN">SENIN</option>
                                <option value="SELASA">SELASA</option>
                                <option value="RABU">RABU</option>
                                <option value="KAMIS">KAMIS</option>
                                <option value="JUM'AT">JUM'AT</option>
                                <option value="SABTU">SABTU</option>
                            </select>
                        </div>
                        <div class="col-md-6 select-box-teacher">
                            <label for="teacher_id" class="col-form-label text-sm-end">Nama Guru
                                <span class="text-danger">*</span>
                            </label>
                            <select id="teacher_id" class="select-teacher form-select" data-allow-clear="true" name="teacher_id">
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="jpm" class="col-form-label text-sm-end">JPM
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="jpm" class="form-control" placeholder="Masukan JPM" name="jpm">
                        </div>

                        <div class="col-md-6 mt-3 select-box-kelompok">
                            <label for="kelompok_id" class="col-form-label text-sm-end">Kelompok
                                <span class="text-danger">*</span>
                            </label>
                            <select id="kelompok_id" class="select-kelompok form-select" data-allow-clear="true" name="kelompok_id">
                            </select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="teacher_id" class="col-form-label text-sm-end">Kegiatan Awal + 30 menit
                                <span class="text-danger">*</span>
                            </label>
                            <div class="row d-flex align-items-center" id="kegiatan_awal">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="teacher_id" class="col-form-label text-sm-end">Kegiatan Inti + 60 menit
                                <span class="text-danger">*</span>
                            </label>
                            <div class="row d-flex align-items-center" id="kegiatan_inti">
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="teacher_id" class="col-form-label text-sm-end">Kegiatan Akhir + 30 menit
                                <span class="text-danger">*</span>
                            </label>
                            <div class="row d-flex align-items-center" id="kegiatan_akhir">
                                
                            </div>
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