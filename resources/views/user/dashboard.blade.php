<x-app>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">


            <div class="row"> <!-- pastikan row memiliki tinggi penuh -->
                <div class="d-flex justify-content-center align-items-center">
                    <!-- card -->
                    <div style="width: 100%; max-width: 300px;">
                                <img src="{{ asset('assets/images/logo-honda.png') }}" class="card-img mt-5" alt="Petani"
                                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        <h1 class="mb-sm-0 font-size-18 text-center logo-txt mt-3">HONDA One Heart</h1>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


        </div>
        <!-- container-fluid -->
    </div>
</x-app>
