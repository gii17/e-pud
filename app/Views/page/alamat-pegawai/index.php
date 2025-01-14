<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Alamat Pegawai
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--alamat__modal" id="new_alamat">Alamat Pegawai Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Alamat Pegawai</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat Rumah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Rumah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Telp.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jarak Kantor</th>
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
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Alamat Pegawai">
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

      <?= $this->include('App\Views\page\alamat-pegawai\form\modal') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_alamat = null;

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
    id_alamat = null;
      $("#add--alamat__modal select[name='nomor_induk']").val("")
      $("#add--alamat__modal input[name='alamat_rumah']").val("")
      $("#add--alamat__modal input[name='status_rumah']").val("")
      $("#add--alamat__modal input[name='nomor_telephone']").val("")
      $("#add--alamat__modal input[name='jarak_kantor']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('alamat-pegawai/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada alamat pegawai saat ini"},
            columns: [
                { 
                data: 'alamat_rumah',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.alamat_rumah}</p>
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
                data: 'status_rumah',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.status_rumah}</h6>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'nomor_telephone',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.nomor_telephone}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'jarak_kantor',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.jarak_kantor}</p>
                      </div>`;
                    return component;
                }
              },

              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class=" btn text-secondary font-weight-bold text-xs" id="btn--edit" data-id_alamat="${row.id_alamat}" data-nomor_induk="${row.nomor_induk}" data-alamat_rumah="${row.alamat_rumah}" data-status_rumah="${row.status_rumah}" data-nomor_telephone="${row.nomor_telephone}"  data-jarak_kantor="${row.jarak_kantor}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Alamat Pegawai">Edit </button>
                    
                    <button class=" btn text-secondary font-weight-bold text-xs" id="btn--delete" data-id_alamat="${row.id_alamat}" data-nomor_induk="${row.nomor_induk}" data-alamat_rumah="${row.alamat_rumah}" data-status_rumah="${row.status_rumah}" data-nomor_telephone="${row.nomor_telephone}"  data-jarak_kantor="${row.jarak_kantor}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Delete Alamat Pegawai">Delete </button>        
                    `;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--alamat__modal .modal-title").html("Edit Alamat Pegawai");
        let id = $(this).attr('key');

        let alamat_rumah = $(el.currentTarget).data('alamat_rumah');
        let status_rumah = $(el.currentTarget).data('status_rumah');
        let nomor_telephone = $(el.currentTarget).data('nomor_telephone');
        let jarak_kantor = $(el.currentTarget).data('jarak_kantor');

        id_alamat = $(el.currentTarget).data('id_alamat');

        $("#add--alamat__modal select[name='nomor_induk']").val(nomor_induk);

        $("#add--alamat__modal input[name='alamat_rumah']").val(alamat_rumah);
        $("#add--alamat__modal input[name='status_rumah']").val(status_rumah);
        $("#add--alamat__modal input[name='nomor_telephone']").val(nomor_telephone);
        $("#add--alamat__modal input[name='jarak_kantor']").val(jarak_kantor);
        $('#add--alamat__modal').modal('toggle');
      });

      $("body").on('click', '#btn--delete', (el) => {
            let id_alamat = $(this).attr('key');
            let nomor_induk = $(el.currentTarget).data('nomor_induk');
            id_alamat = $(el.currentTarget).data('id_alamat');

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
                        url: "<?= base_url('admin/alamat/') ?>"+id_alamat,
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
                                title: "Error, Alamat Pegawai gagal di hapus!"
                            });
                        }
                    });
                }

            });

        });


    

    $(document).ready(function() {

      $("#new_alamat").on("click", function () {
        clearInput(); 
        $("#add--alamat__modal .modal-title").html("Pendaftaran Alamat Pegawai Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id_alamat,
          nomor_induk: $("#add--alamat__modal select[name='nomor_induk']").val(),
          alamat_rumah: $("#add--alamat__modal input[name='alamat_rumah']").val(),
          status_rumah: $("#add--alamat__modal input[name='status_rumah']").val(),
          nomor_telephone: $("#add--alamat__modal input[name='nomor_telephone']").val(),
          jarak_kantor: $("#add--alamat__modal input[name='jarak_kantor']").val(),
          created_at: $("#add--alamat__modal input[name='created_at']").val()
        }


        if(data.id_alamat == null){
          delete data.id_alamat;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/alamatForm') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--alamat__modal').modal('toggle');

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
                title: "Error, alamat pegawai gagal di daftarkan!"
            });
          }
        });

        
        
      });

    });


    </script>

<?= $this->endSection() ?>