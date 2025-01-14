<?= $this->extend('layout/app') ?>

<div class="modal fade" id="surat-pengajuan-pindah-sekolah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Permohonan Surat Pindah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nama_orang_tua" class="col-form-label text-sm-end">Nama Orang Tua siswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_orang_tua" class="form-control" placeholder="Masukan Nama Orang Tua Siswa" name="nama_orang_tua">
                        </div>
                        <div class="col-md-6">
                            <label for="pekerjaan" class="col-form-label text-sm-end">Pekerjaan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="pekerjaan" class="form-control" placeholder="Masukan Pekerjaan Orang Tua Siswa" name="pekerjaan">
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="col-form-label text-sm-end">Alamat
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat" cols="30" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="sekolah_tujuan" class="col-form-label text-sm-end">TK/KB Tujuan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="sekolah_tujuan" class="form-control" placeholder="Masukan TK/KB Tujuan" name="sekolah_tujuan">
                        </div>
                        <div class="col-md-6">
                            <label for="kecamatan" class="col-form-label text-sm-end">Kecamatan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kecamatan" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan">
                        </div>
                        <div class="col-md-6">
                            <label for="kabupaten" class="col-form-label text-sm-end">Kabupaten
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="kabupaten" class="form-control" placeholder="Masukan Kabupaten" name="kabupaten">
                        </div>
                        <div class="col-md-6">
                            <label for="provinsi" class="col-form-label text-sm-end">Provinsi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="provinsi" class="form-control" placeholder="Masukan Provinsi" name="provinsi">
                        </div>
                        <div class="col-md-12">
                            <label for="alasan" class="col-form-label text-sm-end">Alasan Pindah
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="alasan" id="alasan" class="form-control" placeholder="Masukan Alasan Pindah" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn__save">Ajukan</button>
            </div>
        </div>
    </div>
</div>