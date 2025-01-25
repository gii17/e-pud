<div class="modal fade" id="add--teacher__modal" tabindex="-1" aria-labelledby="add--teacher__modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add--teacher__modalLabel">Tambah / Edit Rekognisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/rekognisi/store') ?>" method="POST" id="form-rekognisi">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="rekognisi_id">
                    <div class="mb-3">
                        <label for="rekognisi_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="rekognisi_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_bidang" class="form-label">Bidang</label>
                        <input type="text" class="form-control" id="rekognisi_bidang" name="bidang" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_desc" class="form-label">Rekognisi</label>
                        <textarea class="form-control" id="rekognisi_desc" name="rekognisi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_wilayah" class="form-label">Wilayah</label>
                        <input type="text" class="form-control" id="rekognisi_wilayah" name="wilayah" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_nasional" class="form-label">Nasional</label>
                        <input type="text" class="form-control" id="rekognisi_nasional" name="nasional" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_internasional" class="form-label">Internasional</label>
                        <input type="text" class="form-control" id="rekognisi_internasional" name="internasional" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekognisi_year" class="form-label">Tahun</label>
                        <input type="date" class="form-control" id="rekognisi_year" name="year" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_rekognisi">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
