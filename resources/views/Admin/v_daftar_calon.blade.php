  @extends('layouts.main')
  @section('css')
      <style type="text/css">
          hr {
              margin-top: 1rem;
              margin-bottom: 1rem;
              border: 0;
              border-top: 1px solid rgba(0, 0, 0, 0.1);
          }
      </style>
  @stop
  @section('isi')
      <div class="container-fluid">

          <!-- start page title -->
          <div class="row">
              <div class="col-12">
                  <div class="page-title-box">

                      <h4 class="page-title">{{ $title }}</h4>
                  </div>
              </div>
          </div>
          <!-- end page title -->

          <div class="row">
              <div class="col-xl-12 col-lg-12">
                  <div class="card">
                      <div class="card-body">
                          <div id="scroll-vertical">
                              <table id="mytable" class="table dt-responsive nowrap scroll-vertical scroll-horizontal">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th></th>
                                          <th>Nama Siswa</th>
                                          <th>Informasi</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                          </div> <!-- end preview-->
                      </div> <!-- end preview-->
                  </div> <!-- end preview-->
              </div> <!-- end preview-->
          </div> <!-- end preview-->
      </div> <!-- end preview-->
  @stop
  @section('modal')
      <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                  </div>
                  <div class="modal-body">
                      <form id="tech_report" enctype="multipart/form-data" action="/biodata_siswa" method="POST">
                          <div class="row g-2">
                              <div class="mb-3 col-md-4">
                                  <label for="inputCity" class="form-label">Matematika</label>
                                  <input type="text" class="form-control" id="inputCity" name="nilai_mtk">
                              </div>
                              <div class="mb-3 col-md-4">
                                  <label for="inputState" class="form-label">Bahasa Indonesia</label>
                                  <input type="text" class="form-control" id="inputZip" name="nilai_bin">
                              </div>
                              <div class="mb-3 col-md-4">
                                  <label for="inputZip" class="form-label">Bahasa Inggris</label>
                                  <input type="text" class="form-control" id="inputZip" name="nilai_big">
                              </div>
                              {{-- <div class="mb-3 col-md-3">
                                  <label for="inputZip" class="form-label">Bukti Raport</label>
                                  <input type="file" id="example-fileinput" class="form-control" name="bukti_rapor">
                              </div> --}}
                          </div>

                      </form>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
  @stop
  @section('js')
      <script type="text/javascript">
          let list_siswa = [];

          const table = $("#mytable").DataTable({
              "pageLength": 10,
              "lengthMenu": [
                  [10, 25, 50, 100],
                  [10, 25, 50, 100]
              ],
              "bLengthChange": true,
              "bFilter": true,
              "bInfo": true,
              "processing": true,
              "bServerSide": true,
              "order": [
                  [1, "asc"]
              ],
              "ajax": {
                  url: "{{ url('list_calon') }}",
                  type: "POST",
                  data: function(d) {
                      d._token = "{{ csrf_token() }}"
                  }
              },
              "columnDefs": [{
                  "targets": 0,
                  "data": "id_siswa",
                  "render": function(data, type, row, meta) {
                      list_siswa[row.id_siswa] = row;
                      return meta.row + meta.settings._iDisplayStart + 1;
                      // console.log(list_siswa)
                  }
              }, {
                  "targets": 1,
                  "data": "id_siswa",
                  "render": function(data, type, row, meta) {
                      return `<img id="ttd" src="{{ url('') }}/dok_foto_siswa/${row.foto}"
                                            width="70" height="70">`;

                  }
              }, {
                  "targets": 2,
                  "data": "name",
                  "render": function(data, type, row, meta) {
                      return data;
                  }
              }, {
                  "targets": 3,
                  "sortable": false,
                  "data": "id_siswa",
                  "render": function(data, type, row, meta) {
                      var stts = ``;
                      if (row.status == 1) {
                          stts += `<p>Diterima</p>`
                      } else if (row.status == 2) {
                          stts += `<p>Cadangan</p>`
                      } else if (row.status == 3) {
                          stts += `Tertolak`
                      } else {
                          stts += `<p>--</p>`
                      }
                      return `<p><b>Alamat: </b>` + row.alamat + `<br>` +
                          `<b>Email: </b>` + row.email + `<br>` +
                          `<b>Tempat, Tanggal Lahir: </b>` + row.tempat_lahir + `, ` + row.ttl + `<br>` +
                          `<b>No. HP: </b>` + row.tlp + `<br>` +
                          `<b>Status: </b>` + stts + `</p>` +
                          `<button class="btn btn-sm btn-info" onclick="detailNilai(${row.id_siswa})">Lihat Nilai</button>
                          <a class="btn btn-sm btn-light" href="{{ url('') }}/dok_foto_rapor/${row.bukti_rapor}" target="_blank">Lihat Bukti Rapor</a>`;
                  }
                  //  <a data-bs-toggle="modal" data-bs-target="#modalDetail"><i class='lni lni-eye'></i></a>
              }, {
                  "targets": 4,
                  "data": "is_active",
                  "render": function(data, type, row, meta) {
                      var status = ``;
                      if (data == 1) {
                          status +=
                              `
                              <button class="btn btn-sm btn-success" onclick="terima(${row.id_siswa})">Terima</button>
                              <button class="btn btn-sm btn-secondary" onclick="cadangan(${row.id_siswa})">Cadangan</button>
                                <button class="btn btn-sm btn-danger" onclick="tolak(${row.id_siswa})">Tolak</button>`
                      } else {
                          status +=
                              `<button class="btn btn-sm btn-success" onclick="toggleStatus(${row.id_siswa})">Verifikasi</button>`
                      }
                      return status;
                      //   <button class="btn btn-sm btn-warning" onclick="showEditForm(${row.id_siswa})">Cadangan</button>
                      // <button class="btn btn-sm btn-danger" onclick="hapus(${row.id_siswa})">Tolak</button>`;
                  }
              }]
          });

          function toggleStatus(id_siswa) {

              const _c = confirm("Apakah Anda yakin?")
              if (_c === true) {
                  let siswa = list_siswa[id_siswa]
                  //   console.log(siswa)
                  const status_update = 1
                  const is_kirim = 2
                  $.ajax({
                      url: '{{ url('') }}/update_verif',
                      method: 'POST',
                      data: {
                          id_siswa: id_siswa,
                          id_akun: siswa.id_akun,
                          is_active: status_update,
                          is_kirim: is_kirim,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(res) {
                          if (res === true) {
                              table.ajax.reload(null, false)
                          }
                      }
                  })
              }
          };

          function toggleStatusBatal(id_siswa) {

              const _c = confirm("Apakah Anda yakin?")
              if (_c === true) {
                  let siswa = list_siswa[id_siswa]
                  const status_update = 0
                  const daftar = 0
                  const is_kirim = 1
                  $.ajax({
                      url: '{{ url('') }}/update_status',
                      method: 'POST',
                      data: {
                          id_siswa: id_siswa,
                          is_active: status_update,
                          is_kirim: is_kirim,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(res) {
                          if (res === true) {
                              table.ajax.reload(null, false)
                          }
                      }
                  })
              }
          };

          function terima(id_siswa) {

              const _c = confirm("Apakah Anda yakin?")
              if (_c === true) {
                  let siswa = list_siswa[id_siswa]
                  const status_update = 1
                  $.ajax({
                      url: '{{ url('') }}/status_terima',
                      method: 'POST',
                      data: {
                          id_siswa: id_siswa,
                          status: status_update,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(res) {
                          if (res === true) {
                              table.ajax.reload(null, false)
                          }
                      }
                  })
              }
          };

          function cadangan(id_siswa) {

              const _c = confirm("Apakah Anda yakin?")
              if (_c === true) {
                  let siswa = list_siswa[id_siswa]
                  const status_update = 2
                  $.ajax({
                      url: '{{ url('') }}/status_terima',
                      method: 'POST',
                      data: {
                          id_siswa: id_siswa,
                          status: status_update,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(res) {
                          if (res === true) {
                              table.ajax.reload(null, false)
                          }
                      }
                  })
              }
          };

          function tolak(id_siswa) {

              const _c = confirm("Apakah Anda yakin?")
              if (_c === true) {
                  let siswa = list_siswa[id_siswa]
                  const status_update = 3
                  $.ajax({
                      url: '{{ url('') }}/status_terima',
                      method: 'POST',
                      data: {
                          id_siswa: id_siswa,
                          status: status_update,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(res) {
                          if (res === true) {
                              table.ajax.reload(null, false)
                          }
                      }
                  })
              }
          };

          function detailNilai(id_siswa) {
              const siswa = list_siswa[id_siswa]

              // console.log(siswa)
              $('#bs-example-modal-lg').modal('show')
              //   $("#tech_report [name='id_siswa']").val(siswa.id_siswa)
              $("#tech_report [name='nilai_mtk']").val(siswa.nilai_mtk)
              $("#tech_report [name='nilai_bin']").val(siswa.nilai_bin)
              $("#tech_report [name='nilai_big']").val(siswa.nilai_big)
          }

          function hapus(id_siswa) {
              // console.log(id)
              $('#modalHapus').modal('show')
              const siswa = list_siswa[id_siswa]
              $("#formHapus [name='id_siswa']").val(siswa.id_siswa)
          }
      </script>
  @stop
