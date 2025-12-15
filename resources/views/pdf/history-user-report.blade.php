<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Analisis - {{ $user->name }}</title>
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
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #CC0000;
        }

        .header h1 {
            color: #CC0000;
            font-size: 20px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 16px;
            color: #666;
            font-weight: normal;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 11px;
            color: #999;
        }

        .user-info {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }

        .user-info h3 {
            color: #0d6efd;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 11px;
        }

        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .stat-item {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            text-align: center;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
        }

        .stat-item:nth-child(1) {
            border-right: none;
            background: #fff5f5;
            border-color: #CC0000;
        }

        .stat-item:nth-child(2) {
            background: #f0fff4;
            border-color: #28a745;
        }

        .stat-item:nth-child(3) {
            border-left: none;
            background: #f0f9ff;
            border-color: #17a2b8;
        }

        .stat-item .icon {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .stat-item .label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .stat-item .value {
            font-size: 18px;
            font-weight: bold;
        }

        .stat-item:nth-child(1) .value {
            color: #CC0000;
        }

        .stat-item:nth-child(2) .value {
            color: #28a745;
        }

        .stat-item:nth-child(3) .value {
            color: #17a2b8;
        }

        .section-title {
            background: #CC0000;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin: 25px 0 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #CC0000;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #CC0000;
        }

        table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }

        table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        table tbody tr:hover {
            background: #fff5f5;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 10px;
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

        .badge-primary {
            background: #0d6efd;
            color: white;
        }

        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px;
            margin-top: 20px;
            font-size: 10px;
        }

        .info-box strong {
            color: #856404;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #dee2e6;
            text-align: center;
            font-size: 9px;
            color: #999;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo .icon {
            font-size: 48px;
            color: #CC0000;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="{{ public_path('assets/images/logo-honda.png') }}" alt="Honda Logo" style="height:48px;">
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Laporan Analisis Motor Honda</h1>
        <h2>Sistem Pendukung Keputusan Metode AHP</h2>
        <p>CV. Sinar Baru | JL. Trunojoyo 290B Gedungan Sumenep </p>
    </div>

    <!-- User Info -->
    <div class="user-info">
        <h3>Informasi User</h3>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Total Analisis:</strong> {{ $statistics['total_analisis'] }} kali</p>
        <p><strong>Tanggal Cetak:</strong> {{ $tanggal_cetak }}</p>
    </div>

    <!-- Statistics -->
    <div class="statistics">
        <div class="stat-item">
            {{-- <div class="icon">🏆</div> --}}
            <div class="label">Motor Favorit</div>
            <div class="value">{{ $statistics['motor_favorit'] }}</div>
        </div>
        <div class="stat-item">
            {{-- <div class="icon">⭐</div> --}}
            <div class="label">Skor Tertinggi</div>
            <div class="value">{{ $statistics['skor_tertinggi'] }}</div>
        </div>
        <div class="stat-item">
            {{-- <div class="icon">📅</div> --}}
            <div class="label">Terakhir Analisis</div>
            <div class="value" style="font-size: 12px;">{{ $statistics['terakhir_analisis'] }}</div>
        </div>
    </div>

    <!-- Section Title -->
    <div class="section-title">RIWAYAT ANALISIS LENGKAP</div>

    <!-- History Table -->
    <table>
        <thead>
            <tr>
                <th width="8%" class="text-center">No</th>
                <th width="28%">Tanggal & Waktu</th>
                <th width="44%">Motor Rekomendasi</th>
                <th width="20%" class="text-center">Skor AHP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories->sortByDesc('created_at') as $history)
                <tr>
                    <td class="text-center">
                        <span class="badge badge-secondary">{{ $loop->iteration }}</span>
                    </td>
                    <td>
                        {{ $history->created_at->format('d M Y') }}<br>
                        <small style="color: #666;">{{ $history->created_at->format('H:i') }} WIB</small>
                    </td>
                    <td>
                        <strong style="color: #CC0000;">{{ $history->alternatif->nama ?? '-' }}</strong><br>
                        <small style="color: #666;">Motor Honda</small>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-danger">{{ number_format($history->skor, 3) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Info Box -->
    <div class="info-box">
        <p><strong>Catatan:</strong> Hasil analisis ini merupakan rekomendasi sistem berdasarkan metode Analytical Hierarchy Process (AHP) sesuai dengan kriteria yang dipilih oleh pengguna. Untuk informasi lebih detail mengenai spesifikasi dan harga motor, silakan konsultasi dengan sales kami di CV. Sinar Baru.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Sistem Pendukung Keputusan Pemilihan Motor Honda</strong></p>
        <p>CV. Sinar Baru | Dokumen dicetak pada {{ $tanggal_cetak }}</p>
        <p>Halaman 1 dari 1</p>
    </div>
</body>
</html>
