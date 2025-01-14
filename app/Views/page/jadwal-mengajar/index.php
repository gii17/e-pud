<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Pembagian Jadwal Mengajar
<?= $this->endSection() ?>

<?php if(session()->get('role') == 'is_admin'): ?>
<?= $this->section('action-page') ?>
  <button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--jadwal__modal" id="new_siswa">Jadwal Baru</button>
<?= $this->endSection() ?>
<?php endif; ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Pembagian Jadwal Mengajar</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive pt-0 pb-3 px-2" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Guru</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kegiatan Pembelajaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JPM</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelompok</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>
                          <p class="text-xs mb-0 text-center">SENIN</p>
                      </td>
                      <td>
                        <p class="text-xs mb-0 text-center">Lina Susanti</p>
                      </td>
                      <td class="d-flex align-items-center flex-column">
                      <ol type="I">
                            <li>
                                Kegiatan Awal + 30 menit
                                <ul>
                                    <li>Agama</li>
                                    <li>Sikap Perilaku</li>
                                </ul>
                            </li>

                            <li>
                                Kegiatan Inti + 60 menit
                                <ul>
                                    <li>Bahasa</li>
                                    <li>Kognitif</li>
                                    <li>Fisik Motorik</li>
                                </ul>
                            </li>

                            <li>
                                Kegiatan Akhir + 30 menit
                                <ul>
                                    <li>Seni</li>
                                </ul>
                            </li>
                        </ol>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">5</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">Tulip</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?= $this->include('App\Views\page\jadwal-mengajar\modal\form') ?>
      </div>

    </div>
  
    <script src="<?= base_url('assets/library/libs/jquery/jquery.js')?>"></script>
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>
    <link rel="stylesheet" href="<?= base_url('assets/library/libs/select2/select2.css') ?>"/>
    <script src="<?= base_url('assets/library/libs/select2/select2.js') ?>"></script>

  <script>
      let id_jadwal = null;
        let data = [
            {
                hari: "SENIN",
                nama_guru: "Lina Susanti",
                jpm: 5,
                kelompok: 'tulip',
                kegiatan_awal: ["Agama", "Sikap Perilaku"],
                kegiatan_inti: ["Bahasa", "Kognitif"],
                kegiatan_akhir: ["Seni"]
            }
        ];
        
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

    let kegiatan_awal = [
        {
            text: ''
        },
    ];
    let kegiatan_inti = [
        {
            text: ''
        },
    ];
    let kegiatan_akhir = [
        {
            text: ''
        },
    ];

    function getValKegAwal() {
      let child = $('#kegiatan_awal')[0].children;
      for (let index = 0; index < child.length; index++) {
        const element = child[index];
        kegiatan_awal[index].text = $(element.firstChild.firstChild).val();
      }
    }
    function loadKegiatanAwalEl() {

        kegiatan_awal.forEach((el, idx) => {

            let row = $(`<div class="row d-flex align-items-center" id="kegiatan-${idx}"></div>`)
            let div = $('<div class="col-8 mb-3 input"></div>');
            let input = $(`<input type="text" name="kegiatan_awal${idx+1}" class="form-control" placeholder="Kegiatan ${idx+1}">`);

            if(el.text != ''){
                $(input).val(el.text);
            }
            div.append(input);

            let divAction = $('<div class="col-4 mb-3 ps-0"></div>');
            let btnDelete = $(`<a data-index="${idx}" class="btn mb-0 text-danger delete"><i data-index="${idx}" class="fas fa-trash" aria-hidden="true"></i></a>`);
            if(kegiatan_awal.length <= 1){
               $(btnDelete).addClass('d-none');
            }
            let btnAdd = $(`<a data-index="${idx}" class="btn mb-0 ms-2 text-success add"><i data-index="${idx}" class="fas fa-plus" aria-hidden="true"></i></a>`);
            divAction.append(btnDelete);
            divAction.append(btnAdd);

            row.append(div);
            row.append(divAction);

            $('#kegiatan_awal').append(row);
        });
    }
    loadKegiatanAwalEl();
    $('#kegiatan_awal').on('click', function (e) {

        let el_index = $(e.target).data('index');

        if(e.target.classList.value.includes('fa-trash') || e.target.classList.value.includes('delete')){
            getValKegAwal();
            kegiatan_awal.splice(el_index, 1)
            $(e.currentTarget.children).remove();
            loadKegiatanAwalEl();
        }

        if(e.target.classList.value.includes('fa-plus') || e.target.classList.value.includes('add')){
            getValKegAwal();
            kegiatan_awal.push({ text: '' });
            $(e.currentTarget.children).remove();
            loadKegiatanAwalEl();
        }
    })

    function getValKegInti() {
      let child = $('#kegiatan_inti')[0].children;
      for (let index = 0; index < child.length; index++) {
        const element = child[index];
        kegiatan_inti[index].text = $(element.firstChild.firstChild).val();
      }
    }
    function loadKegiatanIntiEl() {

        kegiatan_inti.forEach((el, idx) => {
            
            let row = $(`<div class="row d-flex align-items-center" id="kegiatan-${idx}"></div>`)
            let div = $('<div class="col-8 mb-3 input"></div>');
            let input = $(`<input type="text" name="kegiatan_inti${idx+1}" class="form-control" placeholder="Kegiatan ${idx+1}">`);

            if(el.text != ''){
                $(input).val(el.text);
            }
            div.append(input);

            let divAction = $('<div class="col-4 mb-3 ps-0"></div>');
            let btnDelete = $(`<a data-index="${idx}" class="btn mb-0 text-danger delete"><i data-index="${idx}" class="fas fa-trash" aria-hidden="true"></i></a>`);
            if(kegiatan_inti.length <= 1){
               $(btnDelete).addClass('d-none');
            }
            let btnAdd = $(`<a data-index="${idx}" class="btn mb-0 ms-2 text-success add"><i data-index="${idx}" class="fas fa-plus" aria-hidden="true"></i></a>`);
            divAction.append(btnDelete);
            divAction.append(btnAdd);

            row.append(div);
            row.append(divAction);

            $('#kegiatan_inti').append(row);
        });
    }
    loadKegiatanIntiEl();
    $('#kegiatan_inti').on('click', function (e) {

        let el_index = $(e.target).data('index');

        if(e.target.classList.value.includes('fa-trash') || e.target.classList.value.includes('delete')){
            getValKegInti();
            kegiatan_inti.splice(el_index, 1)
            $(e.currentTarget.children).remove();
            loadKegiatanIntiEl();
        }

        if(e.target.classList.value.includes('fa-plus') || e.target.classList.value.includes('add')){
            getValKegInti();
            kegiatan_inti.push({ text: '' });
            $(e.currentTarget.children).remove();
            loadKegiatanIntiEl();
        }
    })


    function getValKegAkhir() {
      let child = $('#kegiatan_akhir')[0].children;
      for (let index = 0; index < child.length; index++) {
        const element = child[index];
        kegiatan_akhir[index].text = $(element.firstChild.firstChild).val();
      }
    }
    function loadKegiatanAkhirEl() {

        kegiatan_akhir.forEach((el, idx) => {
            
            let row = $(`<div class="row d-flex align-items-center" id="kegiatan-${idx}"></div>`)
            let div = $('<div class="col-8 mb-3 input"></div>');
            let input = $(`<input type="text" name="kegiatan_akhir${idx+1}" class="form-control" placeholder="Kegiatan ${idx+1}">`);

            if(el.text != ''){
                $(input).val(el.text);
            }
            div.append(input);

            let divAction = $('<div class="col-4 mb-3 ps-0"></div>');
            let btnDelete = $(`<a data-index="${idx}" class="btn mb-0 text-danger delete"><i data-index="${idx}" class="fas fa-trash" aria-hidden="true"></i></a>`);
            if(kegiatan_akhir.length <= 1){
            $(btnDelete).addClass('d-none');
            }
            let btnAdd = $(`<a data-index="${idx}" class="btn mb-0 ms-2 text-success add"><i data-index="${idx}" class="fas fa-plus" aria-hidden="true"></i></a>`);
            divAction.append(btnDelete);
            divAction.append(btnAdd);

            row.append(div);
            row.append(divAction);

            $('#kegiatan_akhir').append(row);
        });
    }
    loadKegiatanAkhirEl();
    $('#kegiatan_akhir').on('click', function (e) {

        let el_index = $(e.target).data('index');

        if(e.target.classList.value.includes('fa-trash') || e.target.classList.value.includes('delete')){
            getValKegAkhir();
            kegiatan_akhir.splice(el_index, 1)
            $(e.currentTarget.children).remove();
            loadKegiatanAkhirEl();
        }

        if(e.target.classList.value.includes('fa-plus') || e.target.classList.value.includes('add')){
            getValKegAkhir();
            kegiatan_akhir.push({ text: '' });
            $(e.currentTarget.children).remove();
            loadKegiatanAkhirEl();
        }
    })

    function clearInput() {
      id_jadwal = null
      $("#add--jadwal__modal select[name='hari']").val(""),
      $("#add--jadwal__modal select[name='teacher_id']").val(""),
      $("#add--jadwal__modal input[name='jpm']").val(""),
      $("#add--jadwal__modal select[name='kelompok_id']").val(""),
      kegiatan_awal = [
          {
              text: ''
          },
      ];
      kegiatan_inti = [
          {
              text: ''
          },
      ];
      kegiatan_akhir = [
          {
              text: ''
          },
      ];
    }

    let select_day = $('.select2').select2({
          dropdownParent: $('.select-box'),
          allowClear: true
      });

    let select_teacher = $('.select-teacher').select2({
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
        dropdownParent: $('.select-box-teacher'),
        allowClear: true
    });
    let select_kelompok = $('.select-kelompok').select2({
        ajax: {
            url: '<?= base_url('api/get-data-kelompok') ?>',
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
        dropdownParent: $('.select-box-kelompok'),
        allowClear: true
    });

    let isAdmin = '<?= session()->get("role") == "is_teacher"?>';
    console.log(isAdmin.length);

    let table = $('.datatables').DataTable( {
            ajax: {
              url: '<?= base_url('jadwal/get-data') ?>',
            },
            processing: true,
            serverSide: true,
            paging: true,
            data,
            language: { emptyTable: "Belum ada jadwal saat ini"},
            columns: [
              { 
                data: 'hari',
                render: function ( data, type, row ) {
                    let component = `<p class="font-weight-bolder text-xs mb-0 text-center">${row.hari}</p>`;
                    return component;
                } 
              },
              { 
                data: 'nama_guru',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.nama_guru}</p>
                        <p class="text-xs text-secondary mb-0">${row.nomor_induk}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'kelompok',
                render: function ( data, type, row ) {
                  let kegiatanAwalList = row.kegiatan_awal.map(el => `<li>${el.text}</li>`).join('');
                  let kegiatanIntiList = row.kegiatan_inti.map(el => `<li>${el.text}</li>`).join('');
                  let kegiatanAkhirList = row.kegiatan_akhir.map(el => `<li>${el.text}</li>`).join('');
                    
                    let component = `<ol type="I">
                            <li>
                                Kegiatan Awal + 30 menit
                                <ul>
                                  ${kegiatanAwalList}
                                </ul>
                            </li>

                            <li>
                                Kegiatan Inti + 60 menit
                                <ul>
                                  ${kegiatanIntiList}
                                </ul>
                            </li>

                            <li>
                                Kegiatan Akhir + 30 menit
                                <ul>
                                  ${kegiatanAkhirList}
                                </ul>
                            </li>
                        </ol>`;

                    return component;
                } 
              },
              { 
                data: 'jpm',
                render: function ( data, type, row ) {
                    return `<p class="text-secondary text-center text-xs font-weight-bold">${row.jpm}</>`;
                }
              },
              { 
                data: 'kelompok',
                render: function ( data, type, row ) {
                    return `<p class="text-secondary text-center text-xs font-weight-bold">${row.nama_kelompok}</p>`;
                }
              },
              { 
                data: 'action',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex align-items-center justify-content-center">
                    <button class="btn p-0 text-secondary font-weight-bold text-xs me-2" id="btn--edit" data-id="${row.id}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit user">Edit </button>
                    <button class="btn p-0 text-danger font-weight-bold text-xs" id="btn--delete" data-id="${row.id}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit user">Hapus </button>
                    </div>`
                    return component;
                }
              },
          ]
      } );

      $( "#btn__save" ).on( "click", function() {
        getValKegAwal()
        getValKegInti()
        getValKegAkhir()
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id: id_jadwal,
          hari: $("#add--jadwal__modal select[name='hari']").val(),
          teacher_id: $("#add--jadwal__modal select[name='teacher_id']").val(),
          jpm: $("#add--jadwal__modal input[name='jpm']").val(),
          kelompok_id: $("#add--jadwal__modal select[name='kelompok_id']").val(),
          kegiatan_awal,
          kegiatan_inti,
          kegiatan_akhir
        }


        if(data.id == null){
          delete data.id;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");
        console.log(data);

        $.ajax({
          url: "<?= base_url('admin/jadwal-mengajar') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--jadwal__modal').modal('toggle');

              clearInput();

              table.ajax.reload();
              window.location.reload();

              Toast.fire({
                icon: "success",
                title: res.message
              });
            }
          },
          error : function(data) {
            $("#btn__save").html("Simpan");
            $( "#btn__save" ).removeAttr("disabled");
            Toast.fire({
                icon: "error",
                title: "Error, Jadwal gagal di buat!"
            });
          }
        });
        
      });


      $("body").on('click', '#btn--delete', (el) => {
        let id = $(el.currentTarget).data('id');

        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Akan menghapus jadwal ini ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak!",
            }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('admin/jadwal-mengajar/') ?>" + id,
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
                            title: "Error, Jadwal gagal di hapus!"
                        });
                    }
                });
            }

        });
    });

    $("body").on('click', '#btn--edit', (el) => {

        $("#add--jadwal__modal .modal-title").html("Edit Data Jadwal");
        let id = $(el.currentTarget).data('id');
        
        $.ajax({
          url: "<?= base_url('admin/jadwal-mengajar/') ?>" + id,
          method: 'GET',
          success : function(res) {
            if(res.status){      
              let data = res.data;

              $("#add--jadwal__modal input[name='jpm']").val(data.jpm);
              $("#add--jadwal__modal select[name='hari']").val(data.hari);

              kegiatan_awal = data.kegiatan_awal;
              kegiatan_inti = data.kegiatan_inti;
              kegiatan_akhir = data.kegiatan_akhir;
              id_jadwal = data.id;

              
              select_day.val(data.hari).trigger('change');
              select_teacher.val(data.nama_guru).trigger('change');
              select_kelompok.val(data.nama_kelompok).trigger('change');
              
              loadKegiatanAwalEl();
              loadKegiatanIntiEl();
              loadKegiatanAkhirEl();

              $('#kegiatan_awal')[0].firstElementChild.remove()
              $('#kegiatan_inti')[0].firstElementChild.remove()
              $('#kegiatan_akhir')[0].firstElementChild.remove()


              $('#add--jadwal__modal').modal('toggle');
            }
          },
        });

      });

    </script>

<?= $this->endSection() ?>