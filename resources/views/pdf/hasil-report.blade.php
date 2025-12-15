<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Rekomendasi Motor Honda</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 4px solid #CC0000;
        }

        .header h1 {
            color: #CC0000;
            font-size: 24px;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header h2 {
            font-size: 16px;
            color: #666;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 11px;
            color: #999;
        }

        .info-section {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #CC0000;
        }

        .info-section h3 {
            color: #CC0000;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .info-label {
            display: table-cell;
            width: 150px;
            font-weight: bold;
            color: #666;
        }

        .info-value {
            display: table-cell;
            color: #333;
        }

        .result-box {
            background: #CC0000;
            color: white;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
            border: 2px solid #990000;
        }

        .result-box h2 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .result-box .motor-name {
            font-size: 26px;
            font-weight: bold;
            margin: 15px 0;
        }

        .result-box .score {
            font-size: 14px;
        }

        .section-title {
            background: #CC0000;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin: 25px 0 15px 0;
        }

        .criteria-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .criteria-item {
            display: table-row;
        }

        .criteria-item > div {
            display: table-cell;
            padding: 12px;
            border: 1px solid #dee2e6;
            background: #fff;
        }

        .criteria-item:nth-child(even) > div {
            background: #f8f9fa;
        }

        .criteria-label {
            font-weight: bold;
            color: #495057;
            width: 200px;
        }

        .criteria-value {
            color: #333;
        }

        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: #CC0000;
            color: white;
            text-align: center;
            line-height: 20px;
            border-radius: 50%;
            margin-right: 8px;
            font-size: 10px;
        }

        .footer-note {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 30px;
        }

        .footer-note p {
            margin: 5px 0;
            font-size: 11px;
            color: #856404;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #dee2e6;
        }

        .footer p {
            font-size: 10px;
            color: #6c757d;
            margin: 3px 0;
        }

        .footer .brand {
            color: #CC0000;
            font-weight: bold;
        }

        .timestamp {
            text-align: right;
            font-size: 10px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body>
     <div class="logo">
        <img src="{{ public_path('assets/images/logo-honda.png') }}" alt="Honda Logo" style="height:48px;">
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Hasil Analisis Motor Honda</h1>
        <h2>Sistem Pendukung Keputusan Metode AHP</h2>
        <p>CV. Sinar Baru | JL. Trunojoyo 290B Gedungan Sumenep </p>
    </div>

    <!-- User Info -->
    <div class="info-section">
        <h3>INFORMASI ANALISIS</h3>
        <div class="info-row">
            <div class="info-label">Nama User</div>
            <div class="info-value">: {{ $hasil->user->name }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Email</div>
            <div class="info-value">: {{ $hasil->user->email }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Analisis</div>
            <div class="info-value">: {{ $hasil->created_at->format('d F Y, H:i') }} WIB</div>
        </div>
        <div class="info-row">
            <div class="info-label">ID Analisis</div>
            <div class="info-value">: #{{ str_pad($hasil->id, 5, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>

    <!-- Result Box -->
    <div class="result-box">
        <h2>REKOMENDASI TERBAIK</h2>
        <div class="motor-name">
            @if(isset($hasil->alternatif) && isset($hasil->alternatif->nama))
                {{ $hasil->alternatif->nama }}
            @else
                Data tidak tersedia
            @endif
        </div>
        <div class="score">
            Skor AHP:
            @if(isset($hasil->skor))
                {{ number_format($hasil->skor, 3) }}
            @else
                0.000
            @endif
        </div>
    </div>

    <!-- Criteria Selected -->
    <div class="section-title">KRITERIA YANG DIPILIH</div>
    <div class="criteria-grid">
        @foreach($subKriterias as $sub)
            <div class="criteria-item">
                <div class="criteria-label">
                    <span class="icon">v</span>
                    {{ $sub->kriteria->nama ?? 'Kriteria' }}
                </div>
                <div class="criteria-value">
                    {{ $sub->nama }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Footer Note -->
    <div class="footer-note">
        <p><strong>CATATAN PENTING:</strong></p>
        <p>• Hasil ini merupakan rekomendasi sistem berdasarkan metode Analytical Hierarchy Process (AHP)</p>
        <p>• Rekomendasi disesuaikan dengan kriteria yang Anda pilih dalam analisis</p>
        <p>• Untuk informasi lebih detail mengenai spesifikasi dan harga, silakan konsultasi dengan sales kami</p>
        <p>• Keputusan akhir pembelian tetap menjadi pertimbangan Anda</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="brand">CV. Sinar Baru - Dealer Resmi Honda Motor</p>
        <p>Sistem Pendukung Keputusan Pemilihan Motor Honda menggunakan Metode AHP</p>
        <p>Dokumen ini dicetak secara otomatis oleh sistem</p>
    </div>

    <div class="timestamp">
        <p>Dicetak pada: {{ $tanggal_cetak }} WIB</p>
    </div>
</body>
</html>
