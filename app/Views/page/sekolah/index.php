<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Sekolah
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--sekolah__modal" id="new_sekolah">Sekolah Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Sekolah</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Sekolah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Sekolah</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelurahan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecamatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kota</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Provinsi</th>
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
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Data Sekolah">
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

      <?= $this->include('App\Views\page\sekolah\modal\form') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_sekolah = null;

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
      id_sekolah = null;
      $("#add--sekolah__modal input[name='nama_sekolah']").val("")
      $("#add--sekolah__modal input[name='status_sekolah']").val("")
      $("#add--sekolah__modal input[name='nomor_statistik']").val("")
      $("#add--sekolah__modal input[name='kelurahan']").val("")
      $("#add--sekolah__modal input[name='kecamatan']").val("")
      $("#add--sekolah__modal input[name='kota']").val("")
      $("#add--sekolah__modal input[name='provinsi']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('sekolah/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada sekolah saat ini"},
            columns: [
              { 
                data: 'nama_sekolah',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.nama_sekolah}</h6>
                            <p class="text-xs text-secondary mb-0">${row.nomor_statistik}</p>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'status_sekolah',
                render: function ( data, type, row ) {
                    return `<p class="text-xs mb-0">${row.status_sekolah}</p>`;
                }
              },
              { 
                data: 'kelurahan',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.kelurahan}</p>
                      </div>`;
                    return component;
                } 
              },
              { 
                data: 'kecamatan',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.kecamatan}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'kota',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.kota}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'provinsi',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.provinsi}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class=" btn text-secondary font-weight-bold text-xs" id="btn--edit" data-id_sekolah="${row.id_sekolah}" data-nama_sekolah="${row.nama_sekolah}" data-nomor_statistik="${row.nomor_statistik}" data-kelurahan="${row.kelurahan}" data-kecamatan="${row.kecamatan}"  data-kota="${row.kota}" data-provinsi="${row.provinsi}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Sekolah">Edit </button>
                    
                    <button class=" btn text-secondary font-weight-bold text-xs" id="btn--delete" data-id_sekolah="${row.id_sekolah}" data-nama_sekolah="${row.nama_sekolah}" data-nomor_statistik="${row.nomor_statistik}" data-kelurahan="${row.kelurahan}" data-kecamatan="${row.kecamatan}"  data-kota="${row.kota}" data-provinsi="${row.provinsi}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Sekolah">Delete </button>`;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--sekolah__modal .modal-title").html("Edit Data Sekolah");
        let id = $(this).attr('key');
        let nama_sekolah = $(el.currentTarget).data('nama_sekolah');
        let nomor_statistik = $(el.currentTarget).data('nomor_statistik');
        let status_sekolah = $(el.currentTarget).data('status_sekolah');

        let kelurahan = $(el.currentTarget).data('kelurahan');
        let kecamatan = $(el.currentTarget).data('kecamatan');
        let kota = $(el.currentTarget).data('kota');
        let provinsi = $(el.currentTarget).data('provinsi');
        id_sekolah = $(el.currentTarget).data('id_sekolah');

        $("#add--sekolah__modal input[name='id_sekolah']").val(id_sekolah);
        $("#add--sekolah__modal input[name='nama_sekolah']").val(nama_sekolah);
        $("#add--sekolah__modal input[name='nomor_statistik']").val(nomor_statistik);
        $("#add--sekolah__modal input[name='status_sekolah']").val(status_sekolah);

        $("#add--sekolah__modal input[name='kelurahan']").val(kelurahan);
        $("#add--sekolah__modal input[name='kecamatan']").val(kecamatan);
        $("#add--sekolah__modal input[name='kota']").val(kota);
        $("#add--sekolah__modal input[name='provinsi']").val(provinsi);
        $('#add--sekolah__modal').modal('toggle');
      });

      $("body").on('click', '#btn--delete', (el) => {
            let id = $(this).attr('key');
            id_sekolah = $(el.currentTarget).data('id_sekolah');

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
                        url: "<?= base_url('admin/sekolah/') ?>"+id_sekolah,
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
                                title: "Error, Sekolah gagal di hapus!"
                            });
                        }
                    });
                }

            });

        });

    

    $(document).ready(function() {

      $("#new_sekolah").on("click", function () {
        clearInput(); 
        $("#add--sekolah__modal .modal-title").html("Pendaftaran Sekolah Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id_sekolah,
          nama_sekolah: $("#add--sekolah__modal input[name='nama_sekolah']").val(),
          nomor_statistik: $("#add--sekolah__modal input[name='nomor_statistik']").val(),
          status_sekolah: $("#add--sekolah__modal select[name='status_sekolah']").val(),
          kelurahan: $("#add--sekolah__modal input[name='kelurahan']").val(),
          kecamatan: $("#add--sekolah__modal input[name='kecamatan']").val(),
          kota: $("#add--sekolah__modal input[name='kota']").val(),
          provinsi: $("#add--sekolah__modal input[name='provinsi']").val()
        }


        if(data.id_sekolah == null){
          delete data.id_sekolah;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/sekolahForm') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--student__modal').modal('toggle');

              clearInput();

              table.ajax.reload();
              //window.location.reload();

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
                title: "Error, Sekolah gagal di daftarkan!"
            });
          }
        });
        
      });

    });


    </script>

<?= $this->endSection() ?>