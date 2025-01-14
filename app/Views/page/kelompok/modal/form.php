<?= $this->extend('layout/app') ?>

<div class="modal fade" id="add--kelompok__modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content px-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Buat Kelompok Baru</h1>
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
                            <label for="nama_kelompok" class="col-form-label text-sm-end">Nama Kelompok
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_kelompok" class="form-control" placeholder="Masukan Nama Kelompok" name="nama_kelompok">
                        </div>
                    
                        <div class="col-md-12 mt-3 select-box">
                            <label for="teacher_id" class="col-form-label text-sm-end">Nama Guru
                                <span class="text-danger">*</span>
                            </label>
                            <select id="teacher_id" class="select-teacher form-select" data-allow-clear="true" name="teacher_id">
                            </select>
                        </div>

                        <div class="col-md-12 mt-3 select-box-student d-none" id="section-form-siswa">
                            <p class="muted--form col-form-label mb-1 mt-3">Tambahkan Siswa Kedalam Kelompok Ini ?</p>
                            <label for="student_id" class="col-form-label text-sm-end">Nama Siswa
                                <span class="text-danger">*</span>
                            </label>
                            <select id="student_id" class="select-student form-select" data-allow-clear="true" name="student_id">
                            </select>
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
    $('.select-teacher').select2({

        ajax: {
            url: '<?= base_url('api/get-data-teacher') ?>',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        },
        // minimumInputLength: 1,
        dropdownParent: $('.select-box'),
        allowClear: true
    });



    $('.select-student').select2({

        ajax: {
            url: '<?= base_url('api/get-data-student') ?>',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        },
        // minimumInputLength: 1,
        dropdownParent: $('.select-box-student'),
        allowClear: true
    });

</script>