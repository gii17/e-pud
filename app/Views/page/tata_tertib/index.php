<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
    Tata Tertib
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
    <button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal"
            data-bs-target="#add--tata-tertib__modal" id="new_tata_tertib">Tata Tertib Baru
    </button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <style>
        .expand-table {
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
                        <?php foreach ($tataTertibList as $tataTertib) : ?>
                            <div class="border-0 p-4 mb-2 bg-gray-100 border-radius-lg mb-4">
                                <div class="expand-container">
                                    <div class="d-flex cursor-pointer accordion">
                                        <div class="d-flex flex-column">
                                            <span class="mb-2 text-xs">Judul:  <br>
                                            <h6 class="mb-3 text-sm"><?= $tataTertib->judul ?></h6>
                                        </div>
                                        <div class="ms-auto text-end">
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                               href="javascript:;" id="delete-tata-tertib"
                                               data-id="<?= $tataTertib->id ?>"
                                               data-judul="<?= $tataTertib->judul ?>"><i
                                                        class="far fa-trash-alt me-2"></i>Hapus</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"
                                               id="edit_kelompok" data-id="<?= $tataTertib->id ?>"
                                               data-judul="<?= $tataTertib->judul ?>" data-bs-toggle="modal"
                                               data-bs-target="#add--tata-tertib__modal"><i
                                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </div>
                                    </div>

                                    <div class="expand-table mt-3">
                                        <div class="table-responsive p-0">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        ID
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                        Judul
                                                    </th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($tataTertib->items as $item) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm"><?= $item->id ?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center flex-column">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $item->deskripsi ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php if (count($tataTertib->items) < 1): ?>
                                                    <tr>
                                                        <td class="mb-0 col-form-label text-center text-info"
                                                            colspan="4">Belum ada siswa dikelompok ini, Silahkan
                                                            masukkan siswa kedalam kelompok ini!
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (count($tataTertibList) < 1): ?>
                            <p class="mb-0 col-form-label text-center">Belum ada tata tertib saat ini, Silahkan buat
                                tata tertib baru!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('App\Views\page\tata_tertib\modal\form') ?>
    </div>

    <script src="<?= base_url('assets/library/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js') ?> "></script>
    <script>


        $(".accordion").on("click", function(e) {
            console.dir(e.currentTarget)
            $(this).toggleClass("active");
            $(this).next().slideToggle(200);
        });


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

        let daftar_aturan = [
            {
                text: ''
            },
        ];

        function getValDaftarAturan() {
            let child = $('#daftar_aturan')[0].children;
            for (let index = 0; index < child.length; index++) {
                const element = child[index];
                daftar_aturan[index].text = $(element.firstChild.firstChild).val();
            }
        }

        function loadDaftarAturanEl() {

            daftar_aturan.forEach((el, idx) => {

                let row = $(`<div class="row d-flex align-items-center" id="aturan-${idx}"></div>`)
                let div = $('<div class="col-8 mb-3 input"></div>');
                let input = $(`<input type="text" name="aturan${idx + 1}" class="form-control" placeholder="Aturan ${idx + 1}">`);

                if (el.text != '') {
                    $(input).val(el.text);
                }
                div.append(input);

                let divAction = $('<div class="col-4 mb-3 ps-0"></div>');
                let btnDelete = $(`<a data-index="${idx}" class="btn mb-0 text-danger delete"><i data-index="${idx}" class="fas fa-trash" aria-hidden="true"></i></a>`);
                if (daftar_aturan.length <= 1) {
                    $(btnDelete).addClass('d-none');
                }
                let btnAdd = $(`<a data-index="${idx}" class="btn mb-0 ms-2 text-success add"><i data-index="${idx}" class="fas fa-plus" aria-hidden="true"></i></a>`);
                divAction.append(btnDelete);
                divAction.append(btnAdd);

                row.append(div);
                row.append(divAction);

                $('#daftar_aturan').append(row);
            });
        }

        loadDaftarAturanEl();
        $('#daftar_aturan').on('click', function (e) {

            let el_index = $(e.target).data('index');

            if (e.target.classList.value.includes('fa-trash') || e.target.classList.value.includes('delete')) {
                getValDaftarAturan();
                daftar_aturan.splice(el_index, 1)
                $(e.currentTarget.children).remove();
                loadDaftarAturanEl();
            }

            if (e.target.classList.value.includes('fa-plus') || e.target.classList.value.includes('add')) {
                getValDaftarAturan();
                daftar_aturan.push({text: ''});
                $(e.currentTarget.children).remove();
                loadDaftarAturanEl();
            }
        })

        $("#new_tata_tertib").on('click', function () {


            // console.log(daftar_aturan)
            daftar_aturan = [
                {
                    text: ''
                }
            ];
            $("#btn__save").text("Simpan");
            $("#btn__save").removeAttr("data-id");
            $('#daftar_aturan').children().remove()
            loadDaftarAturanEl()
            $("#add--tata-tertib__modal input[name='judul']").val(daftar_aturan[0].text)
            // getValDaftarAturan()
        })

        $("#btn__save").on("click", function () {
            const type = $("#btn__save").text()
            getValDaftarAturan()
            let data = {
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                // id: id_user,
                judul: $("#add--tata-tertib__modal input[name='judul']").val(),
                daftar_aturan,
            }
            $("#btn__save").html("Loading...");
            $("#btn__save").attr("disabled", "disabled");
            console.log(data);
            const tataTertibId = $("#btn__save").attr("data-id");
            const url = type.toLowerCase() === "ubah" ? "<?= base_url('admin/tata-tertib') ?>/" + tataTertibId : "<?= base_url('admin/tata-tertib') ?>"

            console.log(url);

            $.ajax({
                url: url,
                method: 'POST',
                data,
                success: function (res) {
                    if (res.status) {
                        $("#btn__save").text(type === "Ubah" ? "Ubah" : "Simpan");
                        $("#btn__save").removeAttr("disabled");
                        $('#add--jadwal__modal').modal('toggle');
                        // table.ajax.reload();
                        window.location.reload();

                        Toast.fire({
                            icon: "success",
                            title: res.message
                        });
                    }
                },
                error: function (data) {
                    $("#btn__save").text(type === "Ubah" ? "Ubah" : "Simpan");
                    $("#btn__save").removeAttr("disabled");
                    Toast.fire({
                        icon: "error",
                        title: "Error, Jadwal gagal di buat!"
                    });
                }
            });

        });

        $("body").on('click', '#edit_kelompok', (el) => {
            const tataTertibId = $(el.currentTarget).data('id')
            $.ajax({
                url: "<?= base_url('admin/tata-tertib/') ?>" + tataTertibId,
                method: 'GET',
                success: function (res) {
                    $("#add--tata-tertib__modal input[name='judul']").val(res.data.judul)
                    daftar_aturan = [];
                    res.data.items.forEach(item => {
                        daftar_aturan.push({text: item.deskripsi});
                    })
                    $('#daftar_aturan').children().remove()
                    loadDaftarAturanEl()
                    getValDaftarAturan();
                    $("#btn__save").text("Ubah")
                    $("#btn__save").attr("data-id", tataTertibId);
                },
                error: function (data) {

                }
            });
        })

        $("body").on('click', '#delete-tata-tertib', (el) => {
            let tata_tertib_id = $(el.currentTarget).data('id');
            let judul = $(el.currentTarget).data('judul');

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Akan menghapus tata tertib " + judul,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak!",
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/tata-tertib/') ?>" + tata_tertib_id,
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
                                title: "Error, Tata tertib gagal di hapus!"
                            });
                        }
                    });
                }

            });
        });


    </script>
<?= $this->endSection() ?>