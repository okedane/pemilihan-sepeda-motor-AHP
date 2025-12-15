<x-login.layout>
    <x-slot:title>Register</x-slot:title>
    <x-toast />
    <div class="login-wrapper">

        <div class="col-lg-4 col-md-6">

            <!-- Judul besar seperti gambar -->
            <div class="title-app">
                APLIKASI SISTEM KPENDUKUNG KEPUTUSAN<br>
                PEMILIHAN SEPEDA MOTOR
            </div>

            <div class="login-card shadow">

                <h4 class="text-center mb-4" style="letter-spacing: 5px; font-weight:700;">REGISTER</h4>

                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Enter name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Enter password" aria-label="Password"
                                aria-describedby="password-addon">
                            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i
                                    class="mdi mdi-eye-outline"></i></button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label">Konfirmasi Password</label>
                            </div>
                        </div>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation"
                                placeholder="Masukkan Ulang Password" aria-label="Konfirmasi Password"
                                aria-describedby="password-confirmation-addon">
                            <button class="btn btn-light shadow-none ms-0" type="button"
                                id="password-confirmation-addon">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100 mb-2">Register</button>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">Login</a>
                </form>

            </div>
        </div>
    </div>
</x-login.layout>
