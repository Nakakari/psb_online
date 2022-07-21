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
                        {{-- <button href="" class=" float-end btn btn-success">Export</button> --}}
                        <h4 class="header-title mt-1 mb-3">Data Diri</h4>

                        <form id="tech_report" enctype="multipart/form-data" action="/biodata_siswa" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Nama</label>
                                    <input type="hidden" name="id_akun" value={{ Auth::user()->id }}>
                                    <input type="text" class="form-control" id="inputEmail4"
                                        value="{{ Auth::user()->name }}" name="name">
                                    <input type="hidden" class="form-control" id="inputEmail4" value="0"
                                        name="is_active">
                                    <input type="hidden" class="form-control" id="inputEmail4" value="2"
                                        name="is_kirim">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" readonly
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="inputAddress" class="form-label">Alamat</label>
                                <textarea class="form-control" placeholder="Alamat tempat tinggal" id="floatingTextarea" style="height: 100px;"
                                    name="alamat" required></textarea>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputAddress2" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Jakarta"
                                        name="tempat_lahir" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputAddress2" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="inputAddress2" name="ttl" required>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputCity" class="form-label">Nomor Handphone</label>
                                    <input type="text" class="form-control" id="inputCity" name="tlp" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputState" class="form-label">Pas Foto</label>
                                    <input type="file" id="example-fileinput" class="form-control" name="foto"
                                        required>
                                </div>
                            </div>
                            <hr>
                            <h4 class="header-title mt-1 mb-3">Nilai</h4>
                            <div class="row g-2">
                                <div class="mb-3 col-md-3">
                                    <label for="inputCity" class="form-label">Matematika</label>
                                    <input type="text" class="form-control" id="inputCity" name="nilai_mtk" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="inputState" class="form-label">Bahasa Indonesia</label>
                                    <input type="text" class="form-control" id="inputZip" name="nilai_bin" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="inputZip" class="form-label">Bahasa Inggris</label>
                                    <input type="text" class="form-control" id="inputZip" name="nilai_big" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="inputZip" class="form-label">Bukti Raport</label>
                                    <input type="file" id="example-fileinput" class="form-control" name="bukti_rapor"
                                        required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@endsection
