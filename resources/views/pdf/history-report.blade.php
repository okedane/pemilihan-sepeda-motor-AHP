<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Analisis Motor Honda</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #CC0000;
        }

        .header h1 {
            color: #CC0000;
            font-size: 18px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 14px;
            color: #666;
            font-weight: normal;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 10px;
            color: #999;
        }

        .info-box {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #CC0000;
        }

        .info-box p {
            margin: 3px 0;
            font-size: 11px;
        }

        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stat-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .stat-item .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-item .value {
            font-size: 16px;
            font-weight: bold;
            color: #CC0000;
        }

        .section-title {
            background: #CC0000;
            color: white;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: bold;
            margin: 20px 0 10px 0;
        }

        .user-block {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .user-header {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 4px solid #0d6efd;
        }

        .user-header h3 {
            font-size: 13px;
            color: #0d6efd;
            margin-bottom: 3px;
        }

        .user-header p {
            font-size: 10px;
            color: #666;
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table thead {
            background: #e9ecef;
        }

        table th {
            padding: 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #dee2e6;
            color: #495057;
        }

        table td {
            padding: 7px;
            border: 1px solid #dee2e6;
            font-size: 10px;
        }

        table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: #CC0000;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-danger {
            background: #CC0000;
            color: white;
        }

        .badge-secondary {
            background: #6c757d;
            color: white;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #999;
            padding: 10px 0;
            border-top: 1px solid #dee2e6;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>


    <div class="logo">
        <img src="{{ public_path('assets/images/logo-honda.png') }}" alt="Honda Logo" style="height:48px;">
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Laporan Riwayat Analisis Motor Honda</h1>
        <h2>Sistem Pendukung Keputusan Metode AHP</h2>
        <p>CV. Sinar Baru | JL. Trunojoyo 290B Gedungan Sumenep </p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <p><strong>Tanggal Cetak:</strong> {{ $tanggal_cetak }}</p>
        <p><strong>Periode Data:</strong> {{ $histories->min('created_at')?->format('d M Y') }} -
            {{ $histories->max('created_at')?->format('d M Y') }}</p>
    </div>

    <!-- Statistics -->
    <div class="statistics">
        <div class="stat-item">
            <div class="label">Total Perhitungan</div>
            <div class="value">{{ $statistics['total_perhitungan'] }}</div>
        </div>
        <div class="stat-item">
            <div class="label">Total User</div>
            <div class="value">{{ $statistics['total_user'] }}</div>
        </div>
        <div class="stat-item">
            <div class="label">Motor Terpopuler</div>
            <div class="value" style="font-size: 11px;">{{ $statistics['motor_terpopuler'] }}</div>
        </div>
        <div class="stat-item">
            <div class="label">Analisis Hari Ini</div>
            <div class="value">{{ $statistics['hari_ini'] }}</div>
        </div>
    </div>

    <!-- Section Title -->
    <div class="section-title">RIWAYAT ANALISIS PER USER</div>

    <!-- Data per User -->
    @foreach ($groupedByUser as $userId => $userHistories)
        @php
            $user = $userHistories->first()->user;
        @endphp

        <div class="user-block">
            <!-- User Header -->
            <div class="user-header">
                <h3>{{ $user->name ?? 'User Tidak Diketahui' }}</h3>
                <p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                <p><strong>Total Analisis:</strong> {{ $userHistories->count() }} kali</p>
            </div>

            <!-- User History Table -->
            <table>
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="25%">Tanggal & Waktu</th>
                        <th width="45%">Motor Rekomendasi</th>
                        <th width="25%" class="text-center">Skor AHP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userHistories->sortByDesc('created_at') as $history)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $history->created_at->format('d M Y - H:i') }} WIB</td>
                            <td><strong>{{ $history->alternatif->nama ?? '-' }}</strong></td>
                            <td class="text-center">
                                <span class="badge badge-danger">{{ number_format($history->skor, 3) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (!$loop->last && $loop->iteration % 3 == 0)
            <div class="page-break"></div>
        @endif
    @endforeach

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh Sistem Pendukung Keputusan Pemilihan Motor Honda - CV. Sinar Baru
        </p>
        <p>Halaman {PAGE_NUM} dari {PAGE_COUNT}</p>
    </div>
</body>

</html>
