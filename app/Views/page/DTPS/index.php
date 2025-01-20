<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data DTPS <?= strtoupper($flag) ?>
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--teacher__modal" id="new_guru">DTPS Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Data DTPS <?= strtoupper($flag) ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink" rowspan="2">Sumber daya</th>
                                <?php
                                    if(isset($flag) && strtoupper($flag) == "PKM") {
                                        $text = "Jumlah Judul PKM";
                                    }else $text = "Jumlah Penelitan";
                                ?>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink" colspan="3"><?= $text ?></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink" rowspan="2">Jenis</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink" rowspan="2">Jumlah</th>
                                <th class="text-secondary opacity-7" style="border:1px solid hotpink" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink">TS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink">TS-1</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="border:1px solid hotpink">TS-2</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($datas as $item): ?>
                                <tr>
                                    <?php foreach ($allowedFields as $field): ?>
                                        <?php
                                            if($field == "flag" ) {
                                                $item[$field] = ($item[$field] == 1) ? "PKM" : "Penelitian";
                                            }
                                        ?>
                                        <?= view('layout/tabel_row', ['item' => $item, 'field' => $field]) ?>
                                    <?php endforeach; ?>
                                    <td>
                                        <div style="display: flex; gap: 10px">
                                            <button class="btn btn-sm btn-secondary edit__button" data-bs-toggle="modal" data-bs-target="#add--teacher__modal"
                                                    data-id="<?= $item['id'] ?? '-' ?>"
                                                    data-name="<?= $item['name'] ?? '-' ?>"
                                                    data-ts="<?= $item['ts'] ?? '-' ?>"
                                                    data-ts1="<?= $item['ts1'] ?? '-' ?>"
                                                    data-ts2="<?= $item['ts2'] ?? '-' ?>"
                                                    data-jumlah="<?= $item['jumlah'] ?? '-' ?>"
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
                const id     = btn.getAttribute('data-id');
                const name     = btn.getAttribute('data-name');
                const ts     = btn.getAttribute('data-ts');
                const ts1    = btn.getAttribute('data-ts1');
                const ts2    = btn.getAttribute('data-ts2');
                const jumlah = btn.getAttribute('data-jumlah');

                document.getElementById('data_id').value       = id;
                document.getElementById('data_name').value    =  name;
                document.getElementById('data_ts').value       = ts;
                document.getElementById('data_ts1').value      = ts1;
                document.getElementById('data_ts2').value      = ts2;
                document.getElementById('data_jumlah').value   = jumlah;
            }, 100)
        })

        const deleteButtons = document.getElementsByClassName('delete__button');
        for (let btn of deleteButtons) {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const name = btn.getAttribute('data-nama');
                const csrf_token  = btn.getAttribute('data-csrf');

                Swal.fire({
                    title: `Apakah Anda yakin ingin menghapus sumber daya ${name}?`,
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
                        fetch('/admin/dtps/delete', {
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
 <?= view('page/DTPS/modal/form',["flag" => $flag]); ?>


<?= $this->endSection() ?>

