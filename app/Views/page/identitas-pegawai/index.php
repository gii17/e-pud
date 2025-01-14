<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Identitas Pegawai
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--identitas__modal" id="new_identitas">Identitas Pegawai Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data status_kepegawaian</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pegawai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tempat Lahir/Tanggal Lahir</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Kepegawaian</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agama</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        
                      </td>
                      <td>
                        <p class="text-xs mb-0"></p>
                      </td>
                      <td>
                        
                      </td>
                      
                      </td>
                      <td class="align-middle text-center">
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Data Pegawai">
                          Edit
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->include('App\Views\page\identitas-pegawai\modal\form') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_identitas = null;

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

    function clearInput() {
      id_identitas = null;
      $("#add--identitas__modal input[name='nomor_induk']").val("")
      $("#add--identitas__modal input[name='jenis_kelamin']").val("")
      $("#add--identitas__modal input[name='tempat_lahir']").val("")
      $("#add--identitas__modal input[name='tanggal_lahir']").val("")
      $("#add--identitas__modal input[name='status_kepegawaian']").val("")
      $("#add--identitas__modal input[name='agama']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('identitas-pegawai/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada identitas siswa saat ini"},
            columns: [
                { 
                data: 'nip',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.nip}</p>
                      </div>`;
                    return component;
                }
              },
                { 
                data: 'nama_lengkap',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.nama_lengkap}</h6>
                            <p class="text-xs text-secondary mb-0">${row.nomor_induk}</p>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'jenis_kelamin',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.jenis_kelamin}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'tanggal_lahir',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.tempat_lahir}</h6>
                            <p class="text-xs text-secondary mb-0">${row.tanggal_lahir}</p>
                          </div>
                        </div>`;
                    return component;
                }
              },
              { 
                data: 'status_kepegawaian',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.status_kepegawaian}</h6>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'agama',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.agama}</p>
                      </div>`;
                    return component;
                }
              },

              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class=" btn text-secondary font-weight-bold text-xs" id="btn--edit" data-id_identitas="${row.id_identitas}" data-nomor_induk="${row.nomor_induk}" data-jenis_kelamin="${row.jenis_kelamin}" data-tempat_lahir="${row.tempat_lahir}" data-tanggal_lahir="${row.tanggal_lahir}"  data-status_kepegawaian="${row.status_kepegawaian}" data-nip="${row.nip}" data-agama="${row.agama}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data status_kepegawaian">Edit </button>
                    
                    <button class=" btn text-secondary font-weight-bold text-xs" id="btn--delete" data-id_identitas="${row.id_identitas}" data-nomor_induk="${row.nomor_induk}" data-jenis_kelamin="${row.jenis_kelamin}" data-tempat_lahir="${row.tempat_lahir}" data-tanggal_lahir="${row.tanggal_lahir}"  data-status_kepegawaian="${row.status_kepegawaian}" data-nip="${row.nip}" data-agama="${row.agama}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data status_kepegawaian">Delete </button>        
                    `;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--identitas__modal .modal-title").html("Edit Data status_kepegawaian");
        let id = $(this).attr('key');
        let nomor_induk = $(el.currentTarget).data('nomor_induk');

        let jenis_kelamin = $(el.currentTarget).data('jenis_kelamin');
        let tempat_lahir = $(el.currentTarget).data('tempat_lahir');
        let tanggal_lahir = $(el.currentTarget).data('tanggal_lahir');
        let agama = $(el.currentTarget).data('agama');
        let nip = $(el.currentTarget).data('nip');
        let status_kepegawaian = $(el.currentTarget).data('status_kepegawaian');

        id_identitas = $(el.currentTarget).data('id_identitas');

        $("#add--identitas__modal select[name='nomor_induk']").val(nomor_induk);

        $("#add--identitas__modal select[name='jenis_kelamin']").val(jenis_kelamin);
        $("#add--identitas__modal input[name='tempat_lahir']").val(tempat_lahir);
        $("#add--identitas__modal input[name='tanggal_lahir']").val(tanggal_lahir);
        $("#add--identitas__modal input[name='status_kepegawaian']").val(status_kepegawaian);
        $("#add--identitas__modal input[name='agama']").val(agama);
        $("#add--identitas__modal input[name='nip']").val(nip);
        $('#add--identitas__modal').modal('toggle');
      });

      $("body").on('click', '#btn--delete', (el) => {
            let id = $(this).attr('key');
            let nomor_induk = $(el.currentTarget).data('nomor_induk');
            id_identitas = $(el.currentTarget).data('id_identitas');

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data akan di delete permanen jika di delete.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak!",
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/identitas/') ?>"+id_identitas,
                        method: 'delete',
                        data: {
                        "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                              },
                        success : function(res) {
                            if(res.status){
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
                            Toast.fire({
                                icon: "error",
                                title: "Error, Identitas gagal di hapus!"
                            });
                        }
                    });
                }

            });

        });


    

    $(document).ready(function() {

      $("#new_identitas").on("click", function () {
        clearInput(); 
        $("#add--identitas__modal .modal-title").html("Pendaftaran Identitas Pegawai Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id_identitas,
          nomor_induk: $("#add--identitas__modal select[name='nomor_induk']").val(),
          jenis_kelamin: $("#add--identitas__modal select[name='jenis_kelamin']").val(),
          tempat_lahir: $("#add--identitas__modal input[name='tempat_lahir']").val(),
          tanggal_lahir: $("#add--identitas__modal input[name='tanggal_lahir']").val(),
          status_kepegawaian: $("#add--identitas__modal input[name='status_kepegawaian']").val(),
          nip: $("#add--identitas__modal input[name='nip']").val(),
          agama: $("#add--identitas__modal input[name='agama']").val(),
          created_at: $("#add--identitas__modal input[name='created_at']").val()
        }


        if(data.id_identitas == null){
          delete data.id_identitas;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/identitasForm') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--identitas__modal').modal('toggle');

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
                title: "Error, Identitas pegawai gagal di daftarkan!"
            });
          }
        });

        
        
      });

    });


    </script>

<?= $this->endSection() ?>