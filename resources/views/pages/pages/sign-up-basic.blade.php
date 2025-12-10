@extends('layouts.custom-master')

@php
$bodyClass = 'authentication-background';
@endphp

@section('styles')
@endsection

@section('content')

<div class="authentication-basic-background">
    <img src="{{asset('build/assets/images/media/backgrounds/9.png')}}" alt="">
</div>

<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-6 col-sm-8 col-12">
            <div class="card custom-card border-0 my-4">
                <div class="card-body p-5">

                    <!-- Logo -->
                    <div class="mb-4">
                        <a href="{{ url('index') }}">
                            <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" 
                                 alt="logo" class="desktop-dark">
                        </a>
                    </div>

                    <div>
                        <h4 class="mb-1 fw-semibold">Daftar</h4>
                        <p class="mb-4 text-muted fw-normal">
                            Gabung hari ini — cukup buat akun gratis untuk memulai.
                        </p>
                    </div>

                    <!-- FORM -->
                    <div class="row gy-3">

                        <!-- Nama Lengkap -->
                        <div class="col-xl-12">
                            <label class="form-label text-default">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap">
                        </div>

                        <!-- Email -->
                        <div class="col-xl-12">
                            <label class="form-label text-default">Email</label>
                            <input type="email" class="form-control" placeholder="Masukkan Email">
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-xl-12">
                            <label class="form-label text-default">Nomor HP</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nomor HP">
                        </div>

                        <!-- Password -->
                        <div class="col-xl-12">
                            <label class="form-label text-default d-block">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                                <a href="javascript:void(0);" class="show-password-button text-muted" 
                                   onclick="createpassword('password',this)">
                                   <i class="ri-eye-off-line align-middle"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="col-xl-12">
                            <label class="form-label text-default d-block">Konfirmasi Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="confirm-password" placeholder="Ulangi Password">
                                <a href="javascript:void(0);" class="show-password-button text-muted" 
                                   onclick="createpassword('confirm-password',this)">
                                   <i class="ri-eye-off-line align-middle"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="col-xl-12">
                            <label class="form-label text-default">Role</label>
                            <select class="form-control">
                                <option value="starter" selected>Starter</option>
                                <option value="professional">Profesional</option>
                                <option value="distributor">Distributor</option>
                            </select>
                        </div>

                    </div>

                    <!-- Tombol Daftar -->
                    <div class="d-grid mt-3">
                        <a href="{{ url('index') }}" class="btn btn-primary">Buat Akun</a>
                    </div>

                    <!-- Separator -->
                    <div class="text-center my-3 authentication-barrier">
                        <span class="op-4 fs-13">atau</span>
                    </div>

                    <!-- Google & Facebook -->
                    <div class="d-grid mb-3">
                        <button class="btn btn-white btn-w-lg border d-flex align-items-center justify-content-center flex-fill mb-3">
                            <span class="avatar avatar-xs">
                                <img src="{{asset('build/assets/images/media/apps/icon-google.png')}}" alt="">
                            </span>
                            <span class="lh-1 ms-2 fs-13 text-default fw-medium">Daftar dengan Google</span>
                        </button>

                        <button class="btn btn-white btn-w-lg border d-flex align-items-center justify-content-center flex-fill">
                            <span class="avatar avatar-xs flex-shrink-0">
                                <img src="{{asset('build/assets/images/media/apps/icon-facebook.png')}}" alt="">
                            </span>
                            <span class="lh-1 ms-2 fs-13 text-default fw-medium">Daftar dengan Facebook</span>
                        </button>
                    </div>

                    <!-- Link ke login -->
                    <div class="text-center mt-3 fw-medium">
                        Sudah memiliki akun?
                        <a href="{{ url('sign-in-basic') }}" class="text-primary">Masuk</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('build/assets/show-password.js')}}"></script>
@endsection
