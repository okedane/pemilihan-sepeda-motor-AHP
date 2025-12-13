<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Riwayat Diagnosa Penyakit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Riwayat Diagnosa Penyakit</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>

                                    <th>Tanggal</th>
                                    <th>Diagnosa</th>
                                    <th>Skor</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayats as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $item->alternatif->nama }}</td>
                                        <td>{{ $item->skor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div>
                        @foreach ($riwayats as $item)
                            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail
                                                Diagnosa
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Diagnosa:</strong>
                                                {{ $item->alternatif->nama }}</p>
                                            <p><strong>Skor:</strong> {{ $item->skor }}</p>
                                            <p><strong>Tanggal:</strong>
                                                {{ $item->created_at->format('d M Y H:i') }}</p>
                                            <hr>
                                            <h6>Subkriteria:</h6>
                                            <ul>
                                                @foreach ($item->subkriteria_list as $sub)
                                                    <li>{{ $sub->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</x-app>
