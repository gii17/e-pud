<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Guru
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--teacher__modal" id="new_guru">Guru Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data Guru</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIDN/NIDK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendidikan Pasca Sarjana</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bidang Keahlian</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan Akademik</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sertifikat Pendidik Profesional</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sertifikat Kompetensi/Profesi/Industri</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah yang Diampu</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kesesuaian Bidang Keahlian Diampu</th>
                                <th class="text-secondary opacity-7">Action</th>
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
                                                    data-nidn="<?= $item['card_identity'] ?? '-' ?>"
                                                    data-pendidikan="<?= $item['postgraduate_degree'] ?? '-' ?>"
                                                    data-jabatan="<?= $item['academic_position'] ?>"
                                                    data-bidang="<?= $item['expertise_area'] ?? '-' ?>"
                                                    data-sertifikat="<?= $item['teaching_certificate'] ?? '-' ?>"
                                                    data-sertifikatkompetensi="<?= $item['competency_certificate'] ?? '-' ?>"
                                                    data-matakuliah="<?= $item['courses_taught'] ?? '-' ?>"
                                                    data-kesesuaian="<?= $item['expertise_fit'] ?? '-' ?>">
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
                const id                    = btn.getAttribute('data-id');
                const name                  = btn.getAttribute('data-nama');
                const nidn                  = btn.getAttribute('data-nidn');
                const pendidikan            = btn.getAttribute('data-pendidikan');
                const bidang                = btn.getAttribute('data-bidang');
                const sertifikat            = btn.getAttribute('data-sertifikat');
                const sertifikatkompetensi  = btn.getAttribute('data-sertifikatkompetensi');
                const matakuliah            = btn.getAttribute('data-matakuliah');
                const kesesuaian            = btn.getAttribute('data-kesesuaian');
                const jabatan               = btn.getAttribute('data-jabatan');

                document.getElementById('teacher_id').value             = id;
                document.getElementById('teacher_name').value           = name;
                document.getElementById('teacher_nidn').value           = nidn;
                document.getElementById('teacher_education').value      = pendidikan;
                document.getElementById('teacher_field').value          = bidang;
                document.getElementById('teacher_certifikat').value     = sertifikat;
                document.getElementById('teacher_certkompetensi').value = sertifikatkompetensi;
                document.getElementById('teacher_mk').value             = matakuliah;
                document.getElementById('teacher_kesesuaian').value     = kesesuaian;
                document.getElementById('academic_position').value      = jabatan;
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
                        fetch('/admin/teacher/delete', {
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
                                        'Data guru telah dihapus.',
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
 <?= view('page/Dosen/modal/form'); ?>


<?= $this->endSection() ?>

