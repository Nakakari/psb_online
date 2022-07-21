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

                    @if ($bio->is_active == 1)
                        <button type="button" class="btn btn-success mb-2"> Terverifikasi</button>
                    @else
                        <button type="button" class="btn btn-success mb-2"> Menunggu Verifikasi</button>
                    @endif
                    @if ($bio->status == 1)
                        <button type="button" class="btn btn-success mb-2"> Diterima</button>
                        <button type="button" class="btn btn-success mb-2"> Lanjut Regristrasi</button>
                    @elseif($bio->status == 2)
                        <button type="button" class="btn btn-warning mb-2"> Cadangan</button>
                    @elseif($bio->status == 3)
                        <button type="button" class="btn btn-danger mb-2"> Anda dinyatakan tidak lolos dalam seleksi
                            ini</button>
                    @else
                    @endif

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('pesan'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>Success - </strong> {{ session('pesan') }}!
                                </div>
                            @elseif (session('hapus'))
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('hapus') }}</strong>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                            @elseif(count($errors) > 0)
                                <div class="col-sm-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                    </div>
                                </div>
                        @endif
                        {{-- <button href="" class=" float-end btn btn-success">Export</button> --}}
                        <h4 class="header-title mt-1 mb-3">Data Diri</h4>
                        @if (Auth::user()->is_kirim == 2)
                            <form id="tech_report" enctype="multipart/form-data" action="/biodata_siswa" method="POST">
                                @csrf
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail4" class="form-label">Nama</label>
                                        <input type="hidden" name="id_akun" value={{ Auth::user()->id }}>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ Auth::user()->name }}" name="name" disabled>
                                        <input type="hidden" class="form-control" id="inputEmail4" value="0"
                                            name="is_active">
                                        <input type="hidden" class="form-control" id="inputEmail4" value="1"
                                            name="is_kirim">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                            readonly value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Alamat</label>
                                    <textarea class="form-control" placeholder="Alamat tempat tinggal" id="floatingTextarea" style="height: 100px;"
                                        name="alamat" disabled>{{ $bio->alamat }}</textarea>
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2" class="form-label">Tempat</label>
                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Jakarta"
                                            name="tempat_lahir" value="{{ $bio->tempat_lahir }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="inputAddress2" name="ttl"
                                            value="{{ $bio->ttl }}" disabled>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputCity" class="form-label">Nomor Handphone</label>
                                        <input type="text" class="form-control" id="inputCity" name="tlp"
                                            value="{{ $bio->tlp }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputState" class="form-label">Pas Foto</label>
                                        <img id="ttd" src="{{ url('') }}/dok_foto_siswa/{{ $bio->foto }}"
                                            width="70" height="70">
                                    </div>
                                </div>
                                <hr>
                                <h4 class="header-title mt-1 mb-3">Nilai</h4>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-3">
                                        <label for="inputCity" class="form-label">Matematika</label>
                                        <input type="text" class="form-control" id="inputCity" name="nilai_mtk"
                                            value="{{ $bio->nilai_mtk }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputState" class="form-label">Bahasa Indonesia</label>
                                        <input type="text" class="form-control" id="inputZip" name="nilai_bin"
                                            value="{{ $bio->nilai_bin }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputZip" class="form-label">Bahasa Inggris</label>
                                        <input type="text" class="form-control" id="inputZip" name="nilai_big"
                                            value="{{ $bio->nilai_big }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputZip" class="form-label">Bukti Raport</label>
                                        {{-- <img id="ttd"
                                            src="{{ url('') }}/dok_foto_rapor/{{ $bio->bukti_rapor }}"
                                            width="70" height="70"> --}}<br>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ url('') }}/dok_foto_rapor/{{ $bio->bukti_rapor }}"
                                            target="_blank">Lihat Bukti Rapor</a>
                                    </div>
                                </div>
                            </form>
                        @else
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
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                            readonly value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputAddress" class="form-label">Alamat</label>
                                    <textarea class="form-control" placeholder="Alamat tempat tinggal" id="floatingTextarea" style="height: 100px;"
                                        name="alamat"></textarea>
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2" class="form-label">Tempat</label>
                                        <input type="text" class="form-control" id="inputAddress2"
                                            placeholder="Jakarta" name="tempat_lahir">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputAddress2" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="inputAddress2" name="ttl">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="inputCity" class="form-label">Nomor Handphone</label>
                                        <input type="text" class="form-control" id="inputCity" name="tlp">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="inputState" class="form-label">Pas Foto</label>
                                        <input type="file" id="example-fileinput" class="form-control"
                                            name="foto">
                                    </div>
                                </div>
                                <hr>
                                <h4 class="header-title mt-1 mb-3">Nilai</h4>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-3">
                                        <label for="inputCity" class="form-label">Matematika</label>
                                        <input type="text" class="form-control" id="inputCity" name="nilai_mtk">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputState" class="form-label">Bahasa Indonesia</label>
                                        <input type="text" class="form-control" id="inputZip" name="nilai_bin">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputZip" class="form-label">Bahasa Inggris</label>
                                        <input type="text" class="form-control" id="inputZip" name="nilai_big">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="inputZip" class="form-label">Bukti Raport</label>
                                        <input type="file" id="example-fileinput" class="form-control"
                                            name="bukti_rapor">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        @endif
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@endsection
