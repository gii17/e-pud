<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Kelompok
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--kelompok__modal" id="new_kelompok">Kelompok Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<style>
.expand-table{
    display: none;
}

</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Kelompok</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <?php foreach ($list_kelompok as $kelompok) : ?>
                <div class="border-0 p-4 mb-2 bg-gray-100 border-radius-lg mb-4">
                 <div class="expand-container">
                     <div class="d-flex cursor-pointer accordion">
                       <div class="d-flex flex-column">
                           <h6 class="mb-3 text-sm"><?=  $kelompok['nama_guru'] ?></h6>
                           <span class="mb-2 text-xs">Nomor Induk: <span class="text-dark font-weight-bold ms-sm-2"><?= $kelompok['nomor_induk'] ?></span></span>
                           <span class="mb-2 text-xs">Kelompok: <span class="text-dark ms-sm-2 font-weight-bold"><?= $kelompok['nama_kelompok'] ?></span></span>
                           <span class="text-xs">Jumlah Siswa: <span class="text-dark ms-sm-2 font-weight-bold"><?= count($kelompok['list_student']) ?></span></span>
                       </div>
                       <div class="ms-auto text-end">
                           <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;" id="delete-kelompok" data-id="<?= $kelompok['kelompok_id'] ?>" data-nama="<?= $kelompok['nama_kelompok'] ?>"><i class="far fa-trash-alt me-2"></i>Hapus</a>
                           <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;" id="edit_kelompok" data-id="<?= $kelompok['kelompok_id'] ?>" data-nama="<?= $kelompok['nama_kelompok'] ?>" data-teacher="<?= $kelompok['teacher_id'] ?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                       </div>
                     </div>
   
                     <div class="expand-table mt-3">
                       <div class="table-responsive p-0">
                           <table class="table align-items-center mb-0">
                           <thead>
                               <tr>
                               <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Identitas Siswa</th>
                               <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                               <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat Tanggal Lahir</th>
                               <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Masuk</th>
                               <th class="text-secondary opacity-7"></th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php foreach ($kelompok['list_student'] as $student) : ?>
                               <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/avatar.png" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?= $student['nama_lengkap'] ?></h6>
                                            <p class="text-xs text-secondary mb-0"><?= $student['nomor_induk'] ?></p>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                            <?php if($student['jenis_kelamin'] == 'L'): ?>
                                            <p class="text-xs text-secondary mb-0">Laki-laki</p>
                                            <?php else: ?>
                                                <p class="text-xs text-secondary mb-0">Perempuan</p>
                                            <?php endif; ?>
                                    </td>
                                    <td>
                                            <div class="d-flex align-items-center flex-column">
                                                <p class="text-xs font-weight-bold mb-0"><?= $student['tempat_lahir'] ?></p>
                                                <p class="text-xs text-secondary mb-0"><?= $student['tanggal_lahir'] ?></p>
                                            </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $student['tahun_masuk'] ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-danger font-weight-bold text-xs" id="remove-student" data-student="<?= $student['user_id'] ?>" data-nama="<?= $student['nama_lengkap'] ?>" data-kelompok="<?= $kelompok['kelompok_id'] ?>" data-toggle="tooltip" data-original-title="Edit user">
                                        Keluarkan
                                        </a>
                                    </td>
                               </tr>
                               <?php endforeach; ?>

                               <?php if(count($kelompok['list_student']) < 1): ?>
                                    <tr>
                                        <td class="mb-0 col-form-label text-center text-info" colspan="4">Belum ada siswa dikelompok ini, Silahkan masukkan siswa kedalam kelompok ini!</td>
                                    </tr>
                                <?php endif; ?>
                           </tbody>
                           </table>
                       </div>
                     </div>
                 </div>
                </div>
                <?php endforeach; ?>

                <?php if(count($list_kelompok) < 1): ?>
                    <p class="mb-0 col-form-label text-center">Belum ada kelompok saat ini, Silahkan buat kelompok baru!</p>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <?= $this->include('App\Views\page\kelompok\modal\form') ?>
</div>


<script src="<?= base_url('assets/library/libs/jquery/jquery.js')?>"></script>
<script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>
<script>
    let id_kelompok = null;

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

    $(".accordion").on("click", function(e) {
        console.dir(e.currentTarget)
        $(this).toggleClass("active");
        $(this).next().slideToggle(200);
    });

    $("body").on('click', '#remove-student', (el) => {
        let student_id = $(el.currentTarget).data('student');
        let nama_siswa = $(el.currentTarget).data('nama');
        let kelompok_id = $(el.currentTarget).data('kelompok');

        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Akan mengeluarkan siswa atas nama "+nama_siswa+" dari kelompok ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Keluarkan!",
            cancelButtonText: "Tidak!",
            }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('admin/kelompok/remove-student/') ?>" + student_id +"/kelompok/"+kelompok_id,
                    method: 'PUT',
                    data: {
                        "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    },
                    success : function(res) {
                        if(res.status){
                            Toast.fire({
                                icon: "success",
                                title: res.message
                            });
                            window.location.reload();
                        }
                    },
                    error : function(data) {
                        Toast.fire({
                            icon: "error",
                            title: "Error, Siswa gagal di keluarkan!"
                        });
                    }
                });
            }

        });
    });

    $("body").on('click', '#delete-kelompok', (el) => {
        let kelompok_id = $(el.currentTarget).data('id');
        let nama_kelompok = $(el.currentTarget).data('nama');

        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Akan menghapus kelompok "+nama_kelompok+" dengan mengeluarkan siswa didalam nya jika tersedia ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak!",
            }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('admin/kelompok/') ?>" + kelompok_id,
                    method: 'DELETE',
                    data: {
                        "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    },
                    success : function(res) {
                        if(res.status){
                            Toast.fire({
                                icon: "success",
                                title: res.message
                            });
                            window.location.reload();
                        }
                    },
                    error : function(data) {
                        Toast.fire({
                            icon: "error",
                            title: "Error, Kelompok gagal di hapus!"
                        });
                    }
                });
            }

        });
    });

    $("body").on('click', '#edit_kelompok', (el) => {

        $('#section-form-siswa').removeClass('d-none');
        
        let nama_kelompok = $(el.currentTarget).data('nama');
        let teacher_id = $(el.currentTarget).data('teacher');
        id_kelompok = $(el.currentTarget).data('id');

        $("#add--kelompok__modal input[name='nama_kelompok']").val(nama_kelompok);
        $("#add--kelompok__modal select[name='teacher_id']").val(teacher_id);


        $("#add--kelompok__modal .modal-title").html("Ubah Kelompok");
        $('#add--kelompok__modal').modal('toggle');
    });

    function clearInput() {
      id_kelompok = null;
      $("#add--kelompok__modal input[name='nama_kelompok']").val("")
      $("#add--kelompok__modal input[name='teacher_id']").val("")
    }

    $(document).ready(function () {

        $("#new_kelompok").on("click", function () {
            $('#section-form-siswa').addClass('d-none');
            clearInput(); 
            $("#add--teacher__modal .modal-title").html("Buat Kelompok Baru");
        });

        $( "#btn__save" ).on( "click", function() {
            let data = {
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                id: id_kelompok,
                nama_kelompok: $("#add--kelompok__modal input[name='nama_kelompok']").val(),
                teacher_id: $("#add--kelompok__modal select[name='teacher_id']").val(),
                student_id: $("#add--kelompok__modal select[name='student_id']").val()
            }


            if(data.id == null){
            delete data.id;
            }
            if(data.student_id == null){
            delete data.student_id;
            }

            $( "#btn__save" ).html("Loading...");
            $( "#btn__save" ).attr("disabled", "disabled");

            $.ajax({
                url: "<?= base_url('admin/kelompok') ?>",
                method: 'POST',
                data,
                success : function(res) {
                    if(res.status){
                    $("#btn__save").html("Simpan");
                    $("#btn__save").removeAttr("disabled");
                    $('#add--kelompok__modal').modal('toggle');

                    clearInput();

                    Toast.fire({
                        icon: "success",
                        title: res.message
                    });
                        window.location.reload();
                    }
                },
                error : function(data) {
                    $("#btn__save").html("Simpan");
                    $( "#btn__save" ).removeAttr("disabled");
                    Toast.fire({
                        icon: "error",
                        title: "Error, Kelompok gagal di buat!"
                    });
                }
            });
        
      });
    });
</script>
<?= $this->endSection() ?>