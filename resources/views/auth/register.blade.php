<x-login.layout>
    <x-slot:title>Register</x-slot:title>
    <x-toast />
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-10 p-10 bg-white rounded-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center"></div>

                        <div class="auth-content my-auto">
                            <div class="card shadow rounded p-4">
                                <div class="text-center">
                                    <a href="#" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/sumenep.jpg') }}" alt="" height="28">
                                        <span class="logo-txt">AHP Hama dan Penyakit Jagung</span>
                                    </a>
                                    <h5 class="mb-0">Daftar Akun</h5>
                                    <p class="text-muted mt-2">Silakan isi data untuk registrasi.</p>
                                </div>

                                <form class="mt-4 pt-2" method="POST" action="{{ route('register') }}" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" placeholder="Masukkan username">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Masukkan email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control" placeholder="Ulangi password">
                                    </div>

                                    <!-- Role tidak perlu ditampilkan karena default petani -->

                                    <div class="mb-3">
                                        <button class="btn w-100" type="submit"
                                            style="background-color: #43b634; border-color: #43b634; color: #fff;">
                                            Register
                                        </button>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-outline-secondary w-100" type="reset">
                                            Reset
                                        </button>
                                    </div>
                                </form>

                                <div class="mb-3 text-center">
                                    <a href="{{ route('login') }}" class="text-primary">Sudah punya akun? Login</a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Sumenep. Crafted with <i class="mdi mdi-heart text-danger"></i> Ujan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-login.layout>
