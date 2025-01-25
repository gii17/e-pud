<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Rekognisi / Pengakuan DTPS
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--teacher__modal" id="new_guru">Tambah Data</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Rekognisi / Pengakuan DTPS</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">Nama Dosen</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">Bidang Keahlian</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">Rekognisi dan Bukti Pendukung</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="3">Tingkat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">Tahun (YYYY)</th>
                                <th class="text-secondary opacity-7" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wilayah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nasional</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">International</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($datas as $item): ?>
                                <tr>
                                    <?php foreach ($allowedFields as $field): ?>
                                        <?= view('layout/tabel_row', ['item' => $item, 'field' => $field]) ?>
                                    <?php endforeach; ?>
                                    <td>
                                        <div style="display: flex; gap: 10px">
                                            <button class="btn btn-sm btn-secondary edit__button" data-bs-toggle="modal" data-bs-target="#add--teacher__modal"
                                                    data-id="<?= $item['id'] ?? '-' ?>"
                                                    data-nama="<?= $item['name'] ?? '-' ?>"
                                                    data-bidang="<?= $item['bidang'] ?? '-' ?>"
                                                    data-rekognisi="<?= $item['rekognisi'] ?? '-' ?>"
                                                    data-wilayah="<?= $item['wilayah'] ?? '-' ?>"
                                                    data-nasional="<?= $item['nasional'] ?? '-' ?>"
                                                    data-internasional="<?= $item['internasional'] ?? '-' ?>"
                                                    data-year="<?= $item['year'] ?? '-' ?>">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete__button"
                                                    data-id="<?= $item['id'] ?? '-' ?>"
                                                    data-nama="<?= $item['name'] ?? '-' ?>"
                                                    data-csrf="<?= csrf_hash() ?>">
                                                Hapus
                                            </button>



                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end" style="margin-right: 30px;">
                            <?= $pager->links('default', 'bootstrap_pagination') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById('add--teacher__modal');
    console.log('modal', modal);
    const form = document.getElementById('form-guru');

    const editButtons = document.getElementsByClassName('edit__button');
    console.log(editButtons)
    for (let btn of editButtons) {
        btn.addEventListener('click', () => {
            setTimeout(() => {
                const data_id            =   btn.getAttribute('data-id');
                const data_nama          =   btn.getAttribute('data-nama');
                const data_bidang        =   btn.getAttribute('data-bidang');
                const data_rekognisi     =   btn.getAttribute('data-rekognisi');
                const data_wilayah       =   btn.getAttribute('data-wilayah');
                const data_nasional      =   btn.getAttribute('data-nasional');
                const data_internasional =   btn.getAttribute('data-internasional');
                const data_year          =   btn.getAttribute('data-year');

                document.getElementById('rekognisi_id').value             = data_id;
                document.getElementById('rekognisi_name').value           = data_nama;
                document.getElementById('rekognisi_bidang').value         = data_bidang;
                document.getElementById('rekognisi_desc').value           = data_rekognisi;
                document.getElementById('rekognisi_wilayah').value        = data_wilayah;
                document.getElementById('rekognisi_nasional').value       = data_nasional;
                document.getElementById('rekognisi_internasional').value  = data_internasional;
                document.getElementById('rekognisi_year').value           = data_year;
            }, 100)
        })

        const deleteButtons = document.getElementsByClassName('delete__button');
        for (let btn of deleteButtons) {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const name = btn.getAttribute('data-nama');
                const csrf_token  = btn.getAttribute('data-csrf');

                Swal.fire({
                    title: `Apakah Anda yakin ingin menghapus guru ${name}?`,
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {

                        // Menggunakan metode POST untuk mengirim permintaan
                        fetch('/admin/rekognisi/delete', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrf_token
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data rekognisi telah dihapus.',
                                        'success'
                                    );
                                    btn.closest('tr').remove();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan, silakan coba lagi.',
                                    'error'
                                );
                            });
                    }
                });
            });
        }



    }
</script>

<!-- Modal Edit/Create -->
 <?= view('page/Rekognisi/modal/form'); ?>


<?= $this->endSection() ?>

