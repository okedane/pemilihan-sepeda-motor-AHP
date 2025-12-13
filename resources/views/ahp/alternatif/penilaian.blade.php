<x-app>
    <div class="page-content">
        <div class="container-fluid">

            {{-- Judul Halaman --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Penilaian Alternatif hama</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Alternatif</a></li>
                                <li class="breadcrumb-item active">Penilaian</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form Penilaian --}}
            <form method="POST" action="{{ route('alternatif.penilaian.simpan') }}">
                @csrf

                <div class="table-responsive" style="overflow-x: auto;">
                    <table class="table table-bordered text-center align-middle" style="min-width: 1400px;">
                        <thead>
                            <tr class="table-primary align-middle text-center">
                                <th rowspan="2">Alternatif</th>
                                @foreach ($kriterias as $kriteria)
                                    <th colspan="{{ $kriteria->subkriterias->count() }}">{{ $kriteria->kode }}</th>
                                @endforeach
                            </tr>
                            <tr class="table-secondary text-center">
                                @foreach ($kriterias as $kriteria)
                                    @foreach ($kriteria->subkriterias as $sub)
                                        <th>{{ $sub->kode }}</th>
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alt)
                                <tr>
                                    <th class="table-primary text-start">{{ $alt->kode }}</th>
                                    @foreach ($kriterias as $kriteria)
                                        @foreach ($kriteria->subkriterias as $sub)
                                            @php
                                                $value = old(
                                                    "nilai.{$alt->id}.{$sub->id}",
                                                    $penilaian[$alt->id][$sub->id] ?? '',
                                                );
                                            @endphp
                                            <td>
                                                <input type="number" step="0.01" min="0" max="5"
                                                    class="form-control text-end" style="min-width: 120px"
                                                    name="nilai[{{ $alt->id }}][{{ $sub->id }}]"
                                                    value="{{ $value }}">
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Matriks
                    </button>
                </div>

            </form>
        </div>
        {{-- Normalisasi --}}
        <div class="mt-5">
            <h5>Hasil Normalisasi</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" style="min-width: 1400px;">
                    <thead>
                        <tr class="table-primary align-middle text-center">
                            <th rowspan="2">Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th colspan="{{ $kriteria->subkriterias->count() }}">{{ $kriteria->kode }}</th>
                            @endforeach
                        </tr>
                        <tr class="table-primary">

                            @foreach ($kriterias as $kriteria)
                                @foreach ($kriteria->subkriterias as $sub)
                                    <th>{{ $sub->kode }}</th>
                                @endforeach
                            @endforeach
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alt)
                            <tr>
                                <th class="table-secondary text-start">{{ $alt->kode }}</th>
                                @foreach ($kriterias as $kriteria)
                                    @foreach ($kriteria->subkriterias as $sub)
                                        <td>
                                            {{ number_format($normalisasi[$alt->id][$sub->id] ?? 0, 3) }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        {{-- Pembobotan --}}
        <div class="mt-5">
            <h5>Hasil Pembobotan</h5>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" style="min-width: 1400px;">
                    <thead>
                        <tr class="table-primary align-middle text-center">
                            <th rowspan="2">Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th colspan="{{ $kriteria->subkriterias->count() }}">{{ $kriteria->kode }}</th>
                            @endforeach
                        </tr>
                        <tr class="table-success">

                            @foreach ($kriterias as $kriteria)
                                @foreach ($kriteria->subkriterias as $sub)
                                    <th>{{ $sub->kode }}</th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alt)
                            <tr>
                                <th class="table-secondary text-start">{{ $alt->kode }}</th>
                                @foreach ($kriterias as $kriteria)
                                    @foreach ($kriteria->subkriterias as $sub)
                                        <td>
                                            {{ number_format($pembobotan[$alt->id][$sub->id] ?? 0, 3) }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</x-app>
