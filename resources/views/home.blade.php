@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">

                                    <i class='bx bx-wallet fs-1'></i>

                                </span>
                                <span class="app-brand-text fs-3 text-body fw-bold">Angelita Finance</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-center">Selamat Datang 👋</h4>
                        <h5 class="text-center">{{ Auth::user()->name }}</h5>
                        <p class="mb-4 text-center">Klik tombol Masuk Ke Dashboard untuk mengelola Data Finance</p>

                        <div class="mb-3">
                            <a class="btn btn-primary d-grid w-100" href="{{ url('admin/dashboard') }}">Masuk Ke
                                Dashboard</a>
                        </div>
                        <div class="divider">
                            <div class="divider-text">Atau</div>
                        </div>
                        <div class="mb-3">
                            <a class="btn btn-danger d-grid w-100" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                Keluar Dari Aplikasi
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>


                        <p class="text-center">
                            {{-- <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a> --}}
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
