<x-app>
    <x-slot:title>Profile</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                <li class="breadcrumb-item active">{{ $user->name }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="avatar-xl me-3">
                                                <img src="assets/images/profilDefault.jpg" alt=""
                                                    class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div>
                                                <h5 class="font-size-18 mb-2 mt-3">{{ ucwords($user->name) }}
                                                </h5>
                                                <p class="text-muted font-size-15" style="text-decoration: underline;">
                                                    {{ ucwords($user->email) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab"
                                role="tablist">
                                <div class="card-body ">
                                    <form action="{{ route('profile.update', $user->id) }}" method="POST"
                                        class="row g-3">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3 mt-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nama Lengkap" value="{{ $user->name }}" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email Aktif" value="{{ $user->email }}" required />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password1"
                                                        placeholder="Masukkan Password" name="password">

                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="togglePassword1">
                                                        <i class="mdi mdi-eye-outline" id="toggleIcon1"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password2"
                                                        placeholder="Masukkan Ulang Password"
                                                        name="password_confirmation">

                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="togglePassword2">
                                                        <i class="mdi mdi-eye-outline" id="toggleIcon2"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <div class="text-sm text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <label for="password-label" style="font-size: 10px;">* Jika Tidak Ada
                                                    perubahan
                                                    Pada Password Tidak Perlu Di Isi !</label>
                                            </div>
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 mt-3 mb-1">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-outline-primary px-4 d-none"
                                                        id="realSubmitButton">
                                                        Save Changes
                                                    </button>
                                                    <button type="button" class="btn btn-outline-primary px-4"
                                                        id="openModalButton">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </ul>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal data -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="data" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title text-warning">
                        Konfirmasi Perubahan
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-4">
                        Apakah Anda yakin ingin menyimpan perubahan ini?
                    </p>
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-exclamation-circle-fill text-warning" style="font-size: 3rem;"></i>
                    </div>
                </div>
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal data -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const openModalButton = document.getElementById('openModalButton');
            const confirmSubmitButton = document.getElementById('confirmSubmit');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));

            // Tampilkan modal saat tombol "Save Changes" ditekan
            openModalButton.addEventListener('click', function() {
                confirmationModal.show();
            });

            // Kirim formulir saat tombol konfirmasi di modal ditekan
            confirmSubmitButton.addEventListener('click', function() {
                confirmationModal.hide();
                document.getElementById('realSubmitButton').click();
            });
        });
    </script>
</x-app>
