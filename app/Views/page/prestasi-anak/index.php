<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Prestasi
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--prestasi__modal" id="new_prestasi">Prestasi Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Prestasi</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Kegiatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Kegiatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi Kegiatan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Siswa</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prestasi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reward</th>
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
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Data Prestasi">
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

      <?= $this->include('App\Views\page\prestasi-anak\modal\form') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_prestasi = null;

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
      id_prestasi = null;
      $("#add--prestasi__modal input[name='nomor_induk']").val("")
      $("#add--prestasi__modal input[name='nama_kegiatan']").val("")
      $("#add--prestasi__modal input[name='tanggal_kegiatan']").val("")
      $("#add--prestasi__modal input[name='lokasi_kegiatan']").val("")
      $("#add--prestasi__modal input[name='prestasi']").val("")
      $("#add--prestasi__modal input[name='reward']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('prestasi/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada prestasi siswa saat ini"},
            columns: [
                { 
                data: 'nama_kegiatan',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.nama_kegiatan}</h6>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'tanggal_kegiatan',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.tanggal_kegiatan}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'lokasi_kegiatan',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.lokasi_kegiatan}</p>
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
                data: 'prestasi',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.prestasi}</p>
                      </div>`;
                    return component;
                } 
              },
              { 
                data: 'reward',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.reward}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class=" btn text-secondary font-weight-bold text-xs" id="btn--edit" data-id_prestasi="${row.id_prestasi}" data-nomor_induk="${row.nomor_induk}" data-nama_kegiatan="${row.nama_kegiatan}" data-tanggal_kegiatan="${row.tanggal_kegiatan}" data-lokasi_kegiatan="${row.lokasi_kegiatan}"  data-prestasi="${row.prestasi}" data-reward="${row.reward}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Prestasi">Edit </button>
                    
                    <button class=" btn text-secondary font-weight-bold text-xs" id="btn--delete" data-id_prestasi="${row.id_prestasi}" data-nomor_induk="${row.nomor_induk}" data-nama_kegiatan="${row.nama_kegiatan}" data-tanggal_kegiatan="${row.tanggal_kegiatan}" data-lokasi_kegiatan="${row.lokasi_kegiatan}"  data-prestasi="${row.prestasi}" data-reward="${row.reward}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Prestasi">Delete </button>        
                    `;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--prestasi__modal .modal-title").html("Edit Data Prestasi");
        let id = $(this).attr('key');
        let nomor_induk = $(el.currentTarget).data('nomor_induk');

        let nama_kegiatan = $(el.currentTarget).data('nama_kegiatan');
        let lokasi_kegiatan = $(el.currentTarget).data('lokasi_kegiatan');
        let prestasi = $(el.currentTarget).data('prestasi');
        let reward = $(el.currentTarget).data('reward');
        id_prestasi = $(el.currentTarget).data('id_prestasi');

        $("#add--prestasi__modal select[name='nomor_induk']").val(nomor_induk);

        $("#add--prestasi__modal input[name='nama_kegiatan']").val(nama_kegiatan);
        $("#add--prestasi__modal input[name='tanggal_kegiatan']").val(tanggal_kegiatan);
        $("#add--prestasi__modal input[name='lokasi_kegiatan']").val(lokasi_kegiatan);
        $("#add--prestasi__modal input[name='prestasi']").val(prestasi);
        $("#add--prestasi__modal input[name='reward']").val(reward);
        $('#add--prestasi__modal').modal('toggle');
      });

      $("body").on('click', '#btn--delete', (el) => {
            let id = $(this).attr('key');
            let nomor_induk = $(el.currentTarget).data('nomor_induk');
            id_prestasi = $(el.currentTarget).data('id_prestasi');

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
                        url: "<?= base_url('admin/prestasi/') ?>"+id_prestasi,
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

      $("#new_prestasi").on("click", function () {
        clearInput(); 
        $("#add--prestasi__modal .modal-title").html("Pendaftaran Prestasi Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id_prestasi,
          nomor_induk: $("#add--prestasi__modal select[name='nomor_induk']").val(),
          nama_kegiatan: $("#add--prestasi__modal input[name='nama_kegiatan']").val(),
          tanggal_kegiatan: $("#add--prestasi__modal input[name='tanggal_kegiatan']").val(),
          lokasi_kegiatan: $("#add--prestasi__modal input[name='lokasi_kegiatan']").val(),
          prestasi: $("#add--prestasi__modal input[name='prestasi']").val(),
          reward: $("#add--prestasi__modal input[name='reward']").val(),
          created_at: $("#add--prestasi__modal input[name='created_at']").val()
        }


        if(data.id_prestasi == null){
          delete data.id_prestasi;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/prestasiForm') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--prestasi__modal').modal('toggle');

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
                title: "Error, Prestasi gagal di daftarkan!"
            });
          }
        });

        
        
      });

    });


    </script>

<?= $this->endSection() ?>