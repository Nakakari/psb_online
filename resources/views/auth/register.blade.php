@extends('layouts.mainRegister')

@section('isi')
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign Up</h4>
        <p class="text-muted mb-4">Selamat Datang! Silakan daftarkan diri Anda untuk mengakses PSB Geneng
            Website.
        </p>
    </div>
    <div class="container">


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Nama Lengkap</label>
                <input name="peran" value="2" type="hidden">
                <input name="is_kirim" value="1" type="hidden">
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="email" value="{{ old('name') }}" required placeholder="Masukkan Nama Lengkap Anda">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Alamat Email</label>
                <input id="name" name="email" type="text"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required placeholder="Masukkan Alamat Email Anda">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Masukkan password Anda">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div> --}}
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input id="password-confirm" type="password"class="form-control" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Konfirmasi password Anda">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div> --}}
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-account-circle"></i>
                        {{ __('Register') }}
                    </button>

                </div>
            </div>
        </form>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
