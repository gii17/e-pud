<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Surat Pindah Sekolah
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body"
            style="background-image: url(<?php if(is_null($data)) echo base_url('assets/img/illustrations/wizard-create-deal-confirm.png'); else echo base_url('assets/img/illustrations/rocket.png'); ?>); background-repeat: no-repeat; background-size: 150px; background-position:top right;"
            >
                <?php if(is_null($data)): ?>
                    <h5 class="card-title mb-0">Anda belum memiliki file <strong>Surat Permohonan Pindah Sekolah</strong>!</h5>
                    <p>Anda dapat segera membuat surat pengajuan melalui sistem e-paud.</p>
                <?php else: ?>
                    <h5 class="card-title mb-0">Pengajuan Anda berhasil di proses!</h5>
                    <p>silahkan download file pengajuan melalui tombol <strong>Dapatkan Surat</strong> dibawah ini!</p>
                <?php endif; ?>

                <div class="d-flex align-items-center">
                    <?php if(is_null($data)): ?>
                        <button type="button" class="btn btn-primary mb-0" style="padding: 11px 37px" data-bs-toggle="modal" data-bs-target="#surat-pengajuan-pindah-sekolah">Buat Surat</button>
                    <?php else: ?>
                        <a class="btn btn-outline-primary btn-sm mb-0 ms-1" style="padding: 10px 28px" href="<?= base_url('student/surat-pindah-sekolah/download/'.$data->id_surat) ?>">Dapatkan Surat</a>
                    <?php endif; ?>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?= $this->include('App\Views\page\surat-pindah-sekolah\modal\form') ?>
    </div>
    <script src="<?= base_url('assets/library/libs/jquery/jquery.js')?>"></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });

        function clearInput() {
            $("#surat-pengajuan-pindah-sekolah input[name='nama_orang_tua']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='pekerjaan']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='alamat']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='sekolah_tujuan']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='kecamatan']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='kabupaten']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='provinsi']").val("")
            $("#surat-pengajuan-pindah-sekolah input[name='alasan']").val("")
        }

        $(document).ready(function() {
            $( "#btn__save" ).on( "click", function() {
                let data = {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    nama_orang_tua: $("#surat-pengajuan-pindah-sekolah input[name='nama_orang_tua']").val(),
                    pekerjaan: $("#surat-pengajuan-pindah-sekolah input[name='pekerjaan']").val(),
                    alamat: $("#surat-pengajuan-pindah-sekolah textarea[name='alamat']").val(),
                    sekolah_tujuan: $("#surat-pengajuan-pindah-sekolah input[name='sekolah_tujuan']").val(),
                    kecamatan: $("#surat-pengajuan-pindah-sekolah input[name='kecamatan']").val(),
                    kabupaten: $("#surat-pengajuan-pindah-sekolah input[name='kabupaten']").val(),
                    provinsi: $("#surat-pengajuan-pindah-sekolah input[name='provinsi']").val(),
                    alasan: $("#surat-pengajuan-pindah-sekolah textarea[name='alasan']").val(),
                }

                $( "#btn__save" ).html("Loading...");
                $( "#btn__save" ).attr("disabled", "disabled");

                $.ajax({
                url: "<?= base_url('student/permohonan-pindah-sekolah') ?>",
                method: 'POST',
                data,
                success : function(res) {
                    if(res.status){
                    $("#btn__save").html("Ajukan");
                    $( "#btn__save" ).removeAttr("disabled");
                    $('#surat-pengajuan-pindah-sekolah').modal('toggle');

                    clearInput();
                    window.location.reload();

                    Toast.fire({
                        icon: "success",
                        title: res.message
                    });
                    }
                },
                error : function(data) {
                    $("#btn__save").html("Simpan");
                    $( "#btn__save" ).removeAttr("disabled");
                    Toast.fire({
                        icon: "error",
                        title: "Error, Siswa gagal di daftarkan!"
                    });
                }
                });
            });
        });
    </script>

<?= $this->endSection() ?>
