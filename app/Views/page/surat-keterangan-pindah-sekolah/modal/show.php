<?= $this->extend('layout/app') ?>

<div class="modal fade" id="show--surat-keterangan-pindah-sekolah__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Preview Keterangan Pindah Sekolah </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <span class="text-lg font-weight-bold">Permohonan Pindah Sekolah </span><br>
                <br>
                <span class="text-md font-weight-bold">Yang bertanda tangan dibawah ini : </span><br>
                <span class="mb-2 text-sm">Nama : <span class="text-dark font-weight-bold ms-sm-2" id="nama_orang_tua"></span></span>
                <br>
                <span class="mb-2 text-sm">Pekerjaan: <span class="text-dark font-weight-bold ms-sm-2" id="pekerjaan"></span></span><br>
                <span class="mb-2 text-sm">Alamat: <span class="text-dark font-weight-bold ms-sm-2" id="alamat"></span></span><br><br>

                <span class="text-md font-weight-bold">Yang bertanda tangan dibawah ini : </span><br>
                <span class="mb-2 text-sm">Nama: <span class="text-dark font-weight-bold ms-sm-2" id="nama_siswa"></span></span><br>
                <span class="mb-2 text-sm">Tempat Tanggal Lahir: <span class="text-dark font-weight-bold ms-sm-2" id="tempat_tanggal_lahir"></span></span>
                <br>
                <span class="mb-2 text-sm">Nomor Induk: <span class="text-dark font-weight-bold ms-sm-2" id="nomor_induk"></span></span>
                <br>
                <span class="mb-2 text-sm">Jenis Kelamin: <span class="text-dark font-weight-bold ms-sm-2" id="jenis_kelamin"></span></span>
                <br>
                <span class="mb-2 text-sm">Siswa Kelompok: <span class="text-dark font-weight-bold ms-sm-2" id="kelompok_siswa"></span></span>
                <br><br>
                <br>

                <span class="text-lg font-weight-bold">Keterangan Pindah Sekolah </span><br>
                <span class="mb-2 text-sm">Nama KB : <span class="text-dark font-weight-bold ms-sm-2" id="nama_kb"></span></span>
                <br>
                <span class="mb-2 text-sm">Status Sekolah : <span class="text-dark font-weight-bold ms-sm-2" id="status_sekolah"></span></span><br>
                <span class="mb-2 text-sm">Alamat Sekolah : <span class="text-dark font-weight-bold ms-sm-2" id="alamat"></span></span><br>
                <span class="mb-2 text-sm">Desa/Kelurahan : <span class="text-dark font-weight-bold ms-sm-2" id="kelurahan"></span></span><br>
                <span class="mb-2 text-sm">Kecamatan : <span class="text-dark font-weight-bold ms-sm-2" id="kecamatan"></span></span><br>
                <span class="mb-2 text-sm">Kabupatan/Kota : <span class="text-dark font-weight-bold ms-sm-2" id="kota"></span></span><br>
                <span class="mb-2 text-sm">Provinsi : <span class="text-dark font-weight-bold ms-sm-2" id="provinsi"></span></span><br>
                <span class="mb-2 text-sm">Diterima Tanggal : <span class="text-dark font-weight-bold ms-sm-2" id="tanggal_diterima"></span></span><br>
                <span class="mb-2 text-sm">Di Kelompok : <span class="text-dark font-weight-bold ms-sm-2" id="kelompok"></span></span><br>

            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" id="btn__download">Download Document</a>
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