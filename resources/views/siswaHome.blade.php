@extends('layouts.main')

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
                        <h4 class="header-title mt-1 mb-3">Informasi Pendaftaran</h4>
                        {{-- <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            You are Siswa.
                        </div> --}}
                        <div class="col-md-6 col-xxl-3">
                            <!-- project card -->
                            <div class="card d-block">
                                <!-- project-thumbnail -->
                                <img class="card-img-top" src="{{ asset('template') }}/assets/images/projects/project-1.jpg"
                                    alt="project image cap">
                                <div class="card-img-overlay">
                                    <div class="badge bg-secondary text-light p-1">Ongoing</div>
                                </div>

                                <div class="card-body position-relative">
                                    <!-- project title-->
                                    <h4 class="mt-0">
                                        <a href="apps-projects-details.html" class="text-title">Company logo design</a>
                                    </h4>

                                    <!-- project detail-->
                                    <p class="mb-3">
                                        <span class="pe-2 text-nowrap">
                                            <i class="mdi mdi-format-list-bulleted-type"></i>
                                            <b>3</b> Tasks
                                        </span>
                                        <span class="text-nowrap">
                                            <i class="mdi mdi-comment-multiple-outline"></i>
                                            <b>104</b> Comments
                                        </span>
                                    </p>


                                    <!-- project progress-->
                                    @if (Auth::user()->is_kirim == 2)
                                        <button class="btn btn-success" id="daftar">Terdaftar</button>
                                    @else
                                        <a href="#" type="button" class="btn btn-warning" readonly>Menunggu
                                        </a>
                                    @endif

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@endsection
@section('modal')
    <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-information h1 text-info"></i>
                        <h4 class="mt-2">Heads up!</h4>
                        <p class="mt-3">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                            facilisis in, egestas eget quam.</p>
                        <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-dialog -->
@stop
@section('js')
    <script type="text/javascript">
        $('#info-alert-modal').modal('show');

        function daftar(id_akun) {
            // console.log(id_akun)

            const _c = confirm("Lanjutkan Untuk Mendaftar?")
            if (_c === true) {

                const daftar = 1
                $.ajax({
                    url: '{{ url('') }}/daftarkan',
                    method: 'POST',
                    data: {
                        id_akun: id_akun,
                        daftar: daftar,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res === true) {
                            document.getElementById("daftar").disabled = true;
                        }
                    }
                })
            }
        };
    </script>
@stop
