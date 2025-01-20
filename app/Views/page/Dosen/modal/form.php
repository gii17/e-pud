<div class="modal fade" id="add--teacher__modal" tabindex="-1" aria-labelledby="add--teacher__modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add--teacher__modalLabel">Tambah / Edit Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/teacher/store') ?>" method="POST" id="form-guru">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="teacher_id">
                    <div class="mb-3">
                        <label for="teacher_name" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="teacher_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_nidn" class="form-label">NIDN/NIDK</label>
                        <input type="text" class="form-control" id="teacher_nidn" name="card_identity" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_education" class="form-label">Pendidikan Pasca Sarjana</label>
                        <input type="text" class="form-control" id="teacher_education" name="postgraduate_degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_education" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="academic_position" name="academic_position" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_field" class="form-label">Bidang Keahlian</label>
                        <input type="text" class="form-control" id="teacher_field" name="expertise_area" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_certifikat" class="form-label">Sertifikat Pendidik Profesional</label>
                        <input type="text" class="form-control" id="teacher_certifikat" name="teaching_certificate" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_certkompetensi" class="form-label">Sertifikat Kompetensi/Profesi/Industri</label>
                        <input type="text" class="form-control" id="teacher_certkompetensi" name="competency_certificate" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_mk" class="form-label">Mata Kuliah yang Diampu</label>
                        <input type="text" class="form-control" id="teacher_mk" name="courses_taught" required>
                    </div>
                    <div class="mb-3">
                        <label for="teacher_kesesuaian" class="form-label">Kesesuaian Bidang Keahlian Diampu</label>
                        <input type="text" class="form-control" id="teacher_kesesuaian" name="expertise_fit" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_teacher">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>