<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Guru
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
              <h6>Data Guru</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Dosen</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIDN/NIDK</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pendidikan Pasca Sarjana</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bidang Keahlian</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sertifikat Pendidik Profesional</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sertifikat  Kompetensi/ Profesi/  Industri</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Kuliah yang Diampu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kesesuaian Bidang Keahlian Diampu</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?= $this->include('App\Views\page\teacher\modal\form') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_user = null;

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
      id_user = null;
      $("#add--teacher__modal input[name='nama_lengkap']").val("")
      $("#add--teacher__modal input[name='nomor_induk']").val("")
      $("#add--teacher__modal select[name='jenis_kelamin']").val("")
      $("#add--teacher__modal input[name='tempat_lahir']").val("")
      $("#add--teacher__modal input[name='tanggal_lahir']").val("")
      $("#add--teacher__modal input[name='tahun_masuk']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('teacher/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada guru saat ini"},
            columns: [
              { 
                data: 'name',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.name}</h6>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'jenis_kelamin',
                render: function ( data, type, row ) {

                    let component;
                    if(row.jenis_kelamin == 'L') component = `<p class="text-xs mb-0 text-center">Laki-laki</p>`
                    else component = `<p class="text-xs mb-0 text-center">Perempuan</p>`

                    return component;
                } 
              },
              { 
                data: 'tanggal_lahir',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.tempat_lahir}</p>
                        <p class="text-xs text-secondary mb-0">${row.tanggal_lahir}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'tahun_masuk',
                render: function ( data, type, row ) {
                    return `<p class="text-secondary text-center text-xs font-weight-bold">${row.tahun_masuk}</p>`;
                }
              },
              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class="btn p-0 text-secondary font-weight-bold text-xs" id="btn--edit" data-nama="${row.nama_lengkap}" data-id="${row.user_id}" data-nomor="${row.nomor_induk}" data-jk="${row.jenis_kelamin}" data-tempat="${row.tempat_lahir}"  data-tanggal="${row.tanggal_lahir}" data-tahun="${row.tahun_masuk}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit user">Edit </button>`;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--teacher__modal .modal-title").html("Edit Data Guru");
        let id = $(this).attr('key');
        let nama_lengkap = $(el.currentTarget).data('nama');
        let nomor_induk = $(el.currentTarget).data('nomor');
        
        let tempat_lahir = $(el.currentTarget).data('tempat');
        let tanggal_lahir = $(el.currentTarget).data('tanggal');
        let tahun_masuk = $(el.currentTarget).data('tahun');
        id_user = $(el.currentTarget).data('id')

        $("#add--teacher__modal input[name='nama_lengkap']").val(nama_lengkap);
        $("#add--teacher__modal input[name='nomor_induk']").val(nomor_induk);
        
        $("#add--teacher__modal input[name='tempat_lahir']").val(tempat_lahir);
        $("#add--teacher__modal input[name='tanggal_lahir']").val(tanggal_lahir);
        $("#add--teacher__modal input[name='tahun_masuk']").val(tahun_masuk);
        $('#add--teacher__modal').modal('toggle');
      });

    

    $(document).ready(function() {

      $("#new_guru").on("click", function () {
        clearInput(); 
        $("#add--teacher__modal .modal-title").html("Pendaftaran Guru Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id: id_user,
          nama_lengkap: $("#add--teacher__modal input[name='nama_lengkap']").val(),
          nomor_induk: $("#add--teacher__modal input[name='nomor_induk']").val(),
          jenis_kelamin: $("#add--teacher__modal select[name='jenis_kelamin']").val(),
          tempat_lahir: $("#add--teacher__modal input[name='tempat_lahir']").val(),
          tanggal_lahir: $("#add--teacher__modal input[name='tanggal_lahir']").val(),
          tahun_masuk: $("#add--teacher__modal input[name='tahun_masuk']").val()
        }


        if(data.id == null){
          delete data.id;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/teacher') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--teacher__modal').modal('toggle');

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
                title: "Error, Guru gagal di daftarkan!"
            });
          }
        });
        
      });

    });


    </script>

<?= $this->endSection() ?>