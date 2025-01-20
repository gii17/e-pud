<div class="modal fade" id="add--teacher__modal" tabindex="-1" aria-labelledby="add--teacher__modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add--teacher__modalLabel">Tambah / Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/dtps/store') ?>" method="POST" id="form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="flag" value="<?= (strtoupper($flag) == "PKM") ? 1 : 0 ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" id="data_id">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="data_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="data_name" name="name" required>
                    </div>

                    <!-- Timestamp ts -->
                    <div class="mb-3">
                        <label for="data_ts" class="form-label">TS</label>
                        <input type="datetime-local" class="form-control" id="data_ts" name="ts" required>
                    </div>

                    <!-- Timestamp ts1 -->
                    <div class="mb-3">
                        <label for="data_ts1" class="form-label">TS - 1</label>
                        <input type="datetime-local" class="form-control" id="data_ts1" name="ts1" required>
                    </div>

                    <!-- Timestamp ts2 -->
                    <div class="mb-3">
                        <label for="data_ts2" class="form-label">TS -  2</label>
                        <input type="datetime-local" class="form-control" id="data_ts2" name="ts2" required>
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="data_jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="data_jumlah" name="jumlah" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_data">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
