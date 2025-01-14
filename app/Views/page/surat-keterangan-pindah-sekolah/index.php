<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
    Data Surat Keterangan Pindah Sekolah
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Data Surat Keterangan Pindah Sekolah</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="overflow-x: hidden !important">
                            <table class="table datatables align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nama
                                        Siswa
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Sekolah Tujuan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Pemohonan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status Pemohonan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($suratPindah as $surat): ?>
                                    <tr>
                                        <td><p class="text-xs mb-0"><?= $surat['id_surat'] ?></p></td>
                                        <td><p class="text-xs mb-0"><?= $surat['nama_siswa'] ?></p></td>
                                        <td><p class="text-xs mb-0"><?= $surat['sekolah_tujuan'] ?></p></td>
                                        <td>
                                            <p class="text-xs mb-0"><?= date("d F Y H:i", strtotime($surat['created_at'])) ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            // Menentukan teks dan class berdasarkan status
                                            $statusText = ($surat['status'] == 1) ? '<span class="text-success text-xs mb-0">Sudah di setujui</span>' : '<span class="text-danger text-xs mb-0">Belum di setujui</span>';
                                            echo $statusText;
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($surat['status'] == 1): ?>
                                                <a class="btn btn-primary" id="btn--preview"
                                                   data-suratid="<?= $surat['id_surat'] ?>" data-bs-toggle="modal"
                                                   data-bs-target="#show--surat-keterangan-pindah-sekolah__modal"><i
                                                            class="fa fa-search"></i></a>
                                            <?php endif ?>
                                            <a class="btn btn-warning" data-bs-toggle="modal"
                                               data-bs-target="#add--surat-keterangan-pindah-sekolah__modal"
                                               data-suratid="<?= $surat['id_surat'] ?>"
                                               data-status="<?= $surat['status'] ?>" id="btn--edit"><i
                                                        class="fa fa-edit"></i></a>

                                            <?php if ($surat['status'] == 1): ?>
                                                <a class="btn btn-danger btn-delete-surat-pindah"
                                                   data-nama_siswa="<?= $surat['nama_siswa'] ?>"
                                                   data-surat_keterangan_pindah_id="<?= $surat['id_surat_keterangan'] ?>"><i
                                                            class="fa fa-trash"></i></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('App\Views\page\surat-keterangan-pindah-sekolah\modal\form') ?>
        <?= $this->include('App\Views\page\surat-keterangan-pindah-sekolah\modal\show') ?>

    </div>

    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js') ?> "></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js') ?> "></script>

    <script>
        let id_user = null;

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

        $("body").on('click', '#btn--edit', (el) => {
            clearInput()

            const suratId = $(el.currentTarget).data('suratid')
            const kelompokId = $(el.currentTarget).data('kelompokid')
            const status = $(el.currentTarget).data('status')
            if (status === 0) {

                $.ajax({
                    url: "<?= base_url('admin/surat-keterangan-pindah-sekolah/get-data/') ?>" + suratId,
                    method: 'GET',
                    success: function (res) {
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").attr("data-id", suratId);
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").attr("data-kelompokid", res.data.id_kelompok);
                        console.log(res)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nama_orang_tua").text(res.data.nama_orang_tua)
                        $("#add--surat-keterangan-pindah-sekolah__modal #pekerjaan").text(res.data.pekerjaan)
                        $("#add--surat-keterangan-pindah-sekolah__modal #alamat").text(res.data.nama_orang_tua)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nama_siswa").text(res.data.nama_siswa)
                        // $("#add--surat-keterangan-pindah-sekolah__modal #nomor_induk").text(res.data.suratPindah.nomor_induk)

                        console.log(res.data.nama_kelompok)

                        const dateObject = new Date(res.data.tanggal_lahir);
                        const options = {day: 'numeric', month: 'long', year: 'numeric'};
                        const formattedDate = dateObject.toLocaleDateString('id-ID', options);
                        $("#add--surat-keterangan-pindah-sekolah__modal #tempat_tanggal_lahir").text(`${res.data.tempat_lahir}, ${formattedDate}`)
                        $("#add--surat-keterangan-pindah-sekolah__modal #jenis_kelamin").text(res.data.jenis_kelamin)
                        $("#add--surat-keterangan-pindah-sekolah__modal #kelompok_siswa").text(res.data.nama_kelompok)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nomor_induk").text(res.data.nomor_induk)
                    },
                    error: function (data) {

                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url('admin/surat-keterangan-pindah-sekolah/get-data/detail/') ?>" + suratId,
                    method: 'GET',
                    success: function (res) {
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").attr("data-id", suratId);
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").attr("data-kelompokid", res.data.suratPindah.id_kelompok);
                        console.log(res)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nama_orang_tua").text(res.data.suratPindah.nama_orang_tua)
                        $("#add--surat-keterangan-pindah-sekolah__modal #pekerjaan").text(res.data.suratPindah.pekerjaan)
                        $("#add--surat-keterangan-pindah-sekolah__modal #alamat").text(res.data.suratPindah.nama_orang_tua)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nama_siswa").text(res.data.suratPindah.nama_siswa)


                        const dateObject = new Date(res.data.suratPindah.tanggal_lahir);
                        const options = {day: 'numeric', month: 'long', year: 'numeric'};
                        const formattedDate = dateObject.toLocaleDateString('id-ID', options);
                        $("#add--surat-keterangan-pindah-sekolah__modal #tempat_tanggal_lahir").text(`${res.data.suratPindah.tempat_lahir}, ${formattedDate}`)
                        $("#add--surat-keterangan-pindah-sekolah__modal #jenis_kelamin").text(res.data.suratPindah.jenis_kelamin)
                        $("#add--surat-keterangan-pindah-sekolah__modal #kelompok_siswa").text(res.data.suratPindah.nama_kelompok)

                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='nama_kb']").val(res.data.nama_kb)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='status_sekolah']").val(res.data.status_sekolah)
                        $("#add--surat-keterangan-pindah-sekolah__modal textarea[name='alamat_sekolah']").val(res.data.alamat_sekolah)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='provinsi']").val(res.data.provinsi)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='kota']").val(res.data.kota)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='kecamatan']").val(res.data.kecamatan)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='kelurahan']").val(res.data.kelurahan)
                        $("#add--surat-keterangan-pindah-sekolah__modal input[name='tanggal_diterima']").val(res.data.tanggal_diterima)
                        $("#add--surat-keterangan-pindah-sekolah__modal #kelompok_siswa").text(res.data.nama_kelompok)
                        $("#add--surat-keterangan-pindah-sekolah__modal #nomor_induk").text(res.data.suratPindah.nomor_induk)

                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").attr("data-surat_keterangan_id", res.data.id);
                    },
                    error: function (data) {

                    }
                });
            }
        });

        $("body").on('click', '#btn--preview', (el) => {
            clearInput()

            const suratId = $(el.currentTarget).data('suratid')
            $.ajax({
                url: "<?= base_url('admin/surat-keterangan-pindah-sekolah/get-data/detail/') ?>" + suratId,
                method: 'GET',
                success: function (res) {
                    $("#show--surat-keterangan-pindah-sekolah__modal #btn__download").attr("data-id", res.data.id);
                    $("#show--surat-keterangan-pindah-sekolah__modal #nama_orang_tua").text(res.data.suratPindah.nama_orang_tua)
                    $("#show--surat-keterangan-pindah-sekolah__modal #pekerjaan").text(res.data.suratPindah.pekerjaan)
                    $("#show--surat-keterangan-pindah-sekolah__modal #alamat").text(res.data.suratPindah.nama_orang_tua)
                    $("#show--surat-keterangan-pindah-sekolah__modal #nama_siswa").text(res.data.suratPindah.nama_siswa)


                    const dateObject = new Date(res.data.suratPindah.tanggal_lahir);
                    const options = {day: 'numeric', month: 'long', year: 'numeric'};
                    const tanggalLahir = dateObject.toLocaleDateString('id-ID', options);
                    $("#show--surat-keterangan-pindah-sekolah__modal #tempat_tanggal_lahir").text(`${res.data.suratPindah.tempat_lahir}, ${tanggalLahir}`)
                    $("#show--surat-keterangan-pindah-sekolah__modal #jenis_kelamin").text(res.data.suratPindah.jenis_kelamin)
                    $("#show--surat-keterangan-pindah-sekolah__modal #kelompok_siswa").text(res.data.nama_kelompok)

                    $("#show--surat-keterangan-pindah-sekolah__modal #nama_kb").text(res.data.nama_kb)
                    $("#show--surat-keterangan-pindah-sekolah__modal #status_sekolah").text(res.data.status_sekolah)
                    $("#show--surat-keterangan-pindah-sekolah__modal #alamat_sekolah").text(res.data.alamat_sekolah)
                    $("#show--surat-keterangan-pindah-sekolah__modal #provinsi").text(res.data.provinsi)
                    $("#show--surat-keterangan-pindah-sekolah__modal #kota").text(res.data.kota)
                    $("#show--surat-keterangan-pindah-sekolah__modal #kecamatan").text(res.data.kecamatan)
                    $("#show--surat-keterangan-pindah-sekolah__modal #kelurahan").text(res.data.kelurahan)
                    $("#show--surat-keterangan-pindah-sekolah__modal #tanggal_diterima").text(res.data.tanggal_diterima)
                    $("#show--surat-keterangan-pindah-sekolah__modal #kelompok").text(res.data.nama_kelompok)
                    $("#show--surat-keterangan-pindah-sekolah__modal #nomor_induk").text(res.data.suratPindah.nomor_induk)


                    const url = '<?= base_url('admin/surat-keterangan-pindah-sekolah/download-document/') ?>' + suratId
                    $("#show--surat-keterangan-pindah-sekolah__modal #btn__download").attr("href",url);
                },
                error: function (data) {

                }
            });
        });


        function clearInput() {
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='nama_kb']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='status_sekolah']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal textarea[name='alamat_sekolah']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='provinsi']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='kota']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='kecamatan']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='kelurahan']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal input[name='tanggal_diterima']").val("")
            $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").removeAttr("data-surat_keterangan_id");
            $("#show--surat-keterangan-pindah-sekolah__modal #btn__download").removeAttr("data-id");
            $("#show--surat-keterangan-pindah-sekolah__modal #btn__download").removeAttr("href");
        }


        $(document).ready(function () {

            $("#btn__save").on("click", function (el) {

                const suratId = $(el.currentTarget).data('id')
                const kelompokId = $(el.currentTarget).data('kelompokid')
                const suratKeteranganId = $(el.currentTarget).data('surat_keterangan_id');
                let data = {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    id: id_user,
                    nama_kb: $("#add--surat-keterangan-pindah-sekolah__modal input[name='nama_kb']").val(),
                    status_sekolah: $("#add--surat-keterangan-pindah-sekolah__modal input[name='status_sekolah']").val(),
                    alamat_sekolah: $("#add--surat-keterangan-pindah-sekolah__modal textarea[name='alamat_sekolah']").val(),
                    provinsi: $("#add--surat-keterangan-pindah-sekolah__modal input[name='provinsi']").val(),
                    kota: $("#add--surat-keterangan-pindah-sekolah__modal input[name='kota']").val(),
                    kecamatan: $("#add--surat-keterangan-pindah-sekolah__modal input[name='kecamatan']").val(),
                    kelurahan: $("#add--surat-keterangan-pindah-sekolah__modal input[name='kelurahan']").val(),
                    tanggal_diterima: $("#add--surat-keterangan-pindah-sekolah__modal input[name='tanggal_diterima']").val(),
                    kelompok_id: kelompokId,
                }

                $("#btn__save").html("Loading...");
                $("#btn__save").attr("disabled", "disabled");
                const url = suratKeteranganId ? "<?= base_url('admin/surat-keterangan-pindah-sekolah/update-data/') ?>" + suratKeteranganId : "<?= base_url('admin/surat-keterangan-pindah-sekolah/send-data/') ?>" + suratId

                $.ajax({
                    url: url,
                    method: 'POST',
                    data,
                    success: function (res) {
                        if (res.status) {
                            $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").html("Simpan");
                            $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").removeAttr("disabled");
                            $('#add--surat-keterangan-pindah-sekolah__modal').modal('toggle');
                            window.location.reload();

                            Toast.fire({
                                icon: "success",
                                title: res.message
                            });
                        }
                    },
                    error: function (data) {
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").html("Simpan");
                        $("#add--surat-keterangan-pindah-sekolah__modal #btn__save").removeAttr("disabled");
                        Toast.fire({
                            icon: "error",
                            title: "Error, Surat keterangan gagal di ubah/tambahkan!"
                        });
                        // window.location.reload()
                    }
                });

            });

            //$("#show--surat-keterangan-pindah-sekolah__modal #btn__download").on("click", function (el) {
            //
            //    const suratId = $(el.currentTarget).data('id')
            //
            //    $("#btn__download").html("Loading...");
            //    $("#btn__download").attr("disabled", "disabled");
            //
            //    $.ajax({
            //        url: '<?php //= base_url('admin/surat-keterangan-pindah-sekolah/download-document/') ?>//' + suratId,
            //        method: 'GET',
            //        success: function (res) {
            //            if (res.status) {
            //                $("#add--surat-keterangan-pindah-sekolah__modal #btn__download").html("Simpan");
            //                $("#add--surat-keterangan-pindah-sekolah__modal #btn__download").removeAttr("disabled");
            //                // window.location.reload();
            //
            //                Toast.fire({
            //                    icon: "success",
            //                    title: res.message
            //                });
            //            }
            //        },
            //        error: function (data) {
            //            $("#add--surat-keterangan-pindah-sekolah__modal #btn__download").html("Simpan");
            //            $("#add--surat-keterangan-pindah-sekolah__modal #btn__download").removeAttr("disabled");
            //            Toast.fire({
            //                icon: "error",
            //                title: "Error, Document gagal di download!"
            //            });
            //            // window.location.reload()
            //        }
            //    });
            //
            //});

            $("body").on('click', '.btn-delete-surat-pindah', (el) => {
                let nama_siswa = $(el.currentTarget).data('nama_siswa');
                let suratKeteranganPindahId = $(el.currentTarget).data('surat_keterangan_pindah_id');
                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: `Akan menghapus permohonan atas nama siswa ${nama_siswa}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak!",
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: "<?= base_url('admin/surat-keterangan-pindah-sekolah/update-status/') ?>" + suratKeteranganPindahId,
                            method: 'DELETE',
                            data: {
                                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                            },
                            success: function (res) {
                                if (res.status) {
                                    Toast.fire({
                                        icon: "success",
                                        title: res.message
                                    });
                                    window.location.reload();
                                }
                            },
                            error: function (data) {
                                Toast.fire({
                                    icon: "error",
                                    title: "Error, Status surat permohonan gagal di ubah!"
                                });
                            }
                        });
                    }

                });
            });


        });


    </script>

<?= $this->endSection() ?>