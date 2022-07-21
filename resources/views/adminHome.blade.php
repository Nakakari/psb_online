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
                        <h4 class="header-title mt-1 mb-3">Jumlah Pendaftar</h4>
                        {{-- <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            You are Siswa.
                        </div> --}}
                        <div class="col-md-6 col-xxl-3">
                            <!-- project card -->
                            <div class="card tilebox-one">
                                <div class="card-body">
                                    <i class='uil uil-users-alt float-end'></i>
                                    <h6 class="text-uppercase mt-0">Active Users</h6>
                                    <h2 class="my-2" id="active-users-count">121</h2>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span>
                                            5.27%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@endsection
