<x-app>
    <x-slot:title>Alternatif</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">alternatif Hama</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active">alternatif</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Daftar alternatif</h4>

                            <div class="d-flex gap-2 ms-auto">
                                <a href="{{ route('alternatif.penilaian.form') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="mdi mdi-table me-1"></i> Penilaian Alternatif
                                </a>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    <i class="mdi mdi-plus me-1"></i> Tambah alternatif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:20px">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>

                                    <td style="text-align: center; width: 100px;">
                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" data-bs-target="#editModal{{ $item->id }}"
                                                    data-bs-toggle="modal"
                                                    class="btn btn-soft-primary waves-effect waves-light"
                                                    style="padding: 3px 6px;">
                                                    <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                </button>



                                                <form action="{{ route('alternatif.delete', $item->id) }}"
                                                    method="POST" id="deleteForm{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" style="padding: 3px 6px;"
                                                        class="btn btn-soft-danger waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}">
                                                        <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                    </button>
                                                </form>

                                                <!-- Modal Konfirmasi Hapus -->
                                                <div class="modal fade" id="deleteModal{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Konfirmasi
                                                                    Penghapusan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus alternatif
                                                                <strong>{{ $item->nama }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="document.getElementById('deleteForm{{ $item->id }}').submit();">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                </tr>

                                <!-- Edit Modal -->
                                <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true" data-bs-scroll="true"
                                    data-bs-backdrop="static">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit
                                                    Data alternatif</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form class="needs-validation"
                                                action="{{ route('alternatif.put', $item->id) }}" method="POST"
                                                novalidate>
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama">Code
                                                            alternatif</label>
                                                        <input type="text" class="form-control" id="kode"
                                                            name="kode" value="{{ $item->kode }}" required>
                                                        <div class="invalid-feedback">Code harus
                                                            diisi.</div>
                                                    </div>
                                                    <!-- Nama -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="nama" value="{{ $item->nama }}" required>
                                                        <div class="invalid-feedback">Nama harus
                                                            diisi.</div>
                                                    </div>




                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Simpan
                                                        Perubahan</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div><!-- /.modal -->
                                </div> <!-- end preview-->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        data-bs-scroll="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{ route('alternatif.post') }}" method="POST"
                        novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Code</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                placeholder="Masukan Code" name="kode" required>
                            <div class="invalid-feedback">
                                Code harus diisi
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Nama</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                placeholder="Masukan Nama" name="nama" required>
                            <div class="invalid-feedback">
                                Nama harus diisi
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan
                                Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app>
