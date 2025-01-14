<?= $this->extend('layout/app') ?>

<?= $this->section('current-page') ?>
Data Keterangan Jasmani Pegawai
<?= $this->endSection() ?>

<?= $this->section('action-page') ?>
<button class="btn btn-outline-primary btn-sm mb-0 me-3" type="button" data-bs-toggle="modal" data-bs-target="#add--jasmani__modal" id="new_jasmani">Keterangan Jasmani Pegawai Baru</button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Keterangan Jasmani</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0" style="overflow-x: hidden !important">
                <table class="table datatables align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Riwayat Penyakit</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pegawai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Berat Badan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tinggi Badan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Golongan Darah</th>
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
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Data Keterangan Jasmani">
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

      <?= $this->include('App\Views\page\jasmani-pegawai\modal\form') ?>

    </div>
  
    <link href="<?= base_url('assets/library/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/library/libs/DataTables/datatables.min.js')?> " ></script>
    <script src="<?= base_url('assets/library/libs/sweetalert2/sweetalert2.min.js')?> " ></script>

    <script>
      let id_jasmani = null;

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
      id_jasmani = null;
      $("#add--jasmani__modal select[name='nomor_induk']").val("")
      $("#add--jasmani__modal input[name='berat_badan']").val("")
      $("#add--jasmani__modal input[name='tinggi_badan']").val("")
      $("#add--jasmani__modal select[name='golongan_darah']").val("")
      $("#add--jasmani__modal input[name='riwayat_penyakit']").val("")
    }

    let table = $('.datatables').DataTable( {
            ajax: {
              url: "<?= base_url('jasmani-pegawai/get-data') ?>",
            },
            processing: true,
            serverSide: true,
            paging: true,
            language: { emptyTable: "Belum ada keterangan jasmani siswa saat ini"},
            columns: [
                { 
                data: 'riwayat_penyakit',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.riwayat_penyakit}</p>
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
                data: 'berat_badan',
                render: function ( data, type, row ) {
                    let component = `<div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">${row.berat_badan}</h6>
                          </div>
                        </div>`;
                    return component;
                } 
              },
              { 
                data: 'tinggi_badan',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.tinggi_badan}</p>
                      </div>`;
                    return component;
                }
              },
              { 
                data: 'golongan_darah',
                render: function ( data, type, row ) {
                    let component = `
                      <div class="d-flex align-items-center flex-column">
                        <p class="text-xs font-weight-bold mb-0">${row.golongan_darah}</p>
                      </div>`;
                    return component;
                }
              },

              { 
                data: 'action',
                render: function ( data, type, row ) {
                    return `<button class=" btn text-secondary font-weight-bold text-xs" id="btn--edit" data-id_jasmani="${row.id_jasmani}" data-nomor_induk="${row.nomor_induk}" data-berat_badan="${row.berat_badan}" data-tinggi_badan="${row.tinggi_badan}" data-golongan_darah="${row.golongan_darah}"  data-riwayat_penyakit="${row.riwayat_penyakit}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Keterangan Jasmani">Edit </button>
                    
                    <button class=" btn text-secondary font-weight-bold text-xs" id="btn--delete" data-id_jasmani="${row.id_jasmani}" data-nomor_induk="${row.nomor_induk}" data-berat_badan="${row.berat_badan}" data-tinggi_badan="${row.tinggi_badan}" data-golongan_darah="${row.golongan_darah}"  data-riwayat_penyakit="${row.riwayat_penyakit}" data-toggle="tooltip" style="box-shadow: none !important; text-transform: none;" data-original-title="Edit Data Keterangan Jasmani">Delete </button>        
                    `;
                }
              },
          ]
      } );

      $("body").on('click', '#btn--edit', (el) => {
        $("#add--jasmani__modal .modal-title").html("Edit Data Keterangan Jasmani");
        let id = $(this).attr('key');
        let nomor_induk = $(el.currentTarget).data('nomor_induk');

        let tinggi_badan = $(el.currentTarget).data('tinggi_badan');
        let berat_badan = $(el.currentTarget).data('berat_badan');
        let golongan_darah = $(el.currentTarget).data('golongan_darah');
        let riwayat_penyakit = $(el.currentTarget).data('riwayat_penyakit');

        id_jasmani = $(el.currentTarget).data('id_jasmani');

        $("#add--jasmani__modal select[name='nomor_induk']").val(nomor_induk);

        $("#add--jasmani__modal input[name='berat_badan']").val(berat_badan);
        $("#add--jasmani__modal input[name='tinggi_badan']").val(tinggi_badan);
        $("#add--jasmani__modal select[name='golongan_darah']").val(golongan_darah);
        $("#add--jasmani__modal input[name='riwayat_penyakit']").val(riwayat_penyakit);
        $('#add--jasmani__modal').modal('toggle');
      });

      $("body").on('click', '#btn--delete', (el) => {
            let id = $(this).attr('key');
            let nomor_induk = $(el.currentTarget).data('nomor_induk');
            id_jasmani = $(el.currentTarget).data('id_jasmani');

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
                        url: "<?= base_url('admin/jasmani/') ?>"+id_jasmani,
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
                                title: "Error, Keterangan Jasmani gagal di hapus!"
                            });
                        }
                    });
                }

            });

        });


    

    $(document).ready(function() {

      $("#new_jasmani").on("click", function () {
        clearInput(); 
        $("#add--jasmani__modal .modal-title").html("Pendaftaran Keterangan jasmani Baru");
      });


      $( "#btn__save" ).on( "click", function() {
        let data = {
          "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
          id_jasmani,
          nomor_induk: $("#add--jasmani__modal select[name='nomor_induk']").val(),
          berat_badan: $("#add--jasmani__modal input[name='berat_badan']").val(),
          tinggi_badan: $("#add--jasmani__modal input[name='tinggi_badan']").val(),
          golongan_darah: $("#add--jasmani__modal select[name='golongan_darah']").val(),
          riwayat_penyakit: $("#add--jasmani__modal input[name='riwayat_penyakit']").val(),
          created_at: $("#add--jasmani__modal input[name='created_at']").val()
        }


        if(data.id_jasmani == null){
          delete data.id_jasmani;
        }

        $( "#btn__save" ).html("Loading...");
        $( "#btn__save" ).attr("disabled", "disabled");

        $.ajax({
          url: "<?= base_url('admin/jasmaniForm') ?>",
          method: 'POST',
          data,
          success : function(res) {
            if(res.status){
              $("#btn__save").html("Simpan");
              $( "#btn__save" ).removeAttr("disabled");
              $('#add--jasmani__modal').modal('toggle');

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
                title: "Error, keterangan jasmani gagal di daftarkan!"
            });
          }
        });

        
        
      });

    });


    </script>

<?= $this->endSection() ?>