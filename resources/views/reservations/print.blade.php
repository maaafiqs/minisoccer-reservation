<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Bukti Reservasi - Maaafiqs Mini Soccer</title>
    <!-- Use Google Fonts for better typography in print -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            color: #1f2937; 
            margin: 0; 
            padding: 40px; 
            background-color: #f3f4f6;
        }
        .invoice-box { 
            max-width: 800px; 
            margin: auto; 
            background: #fff; 
            padding: 50px; 
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 8px solid #16a34a;
            position: relative;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(22, 163, 74, 0.03);
            white-space: nowrap;
            z-index: 0;
            pointer-events: none;
            font-weight: 800;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start;
            border-bottom: 2px solid #f3f4f6; 
            padding-bottom: 30px; 
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        .header-logo h1 { 
            color: #16a34a; 
            margin: 0 0 5px 0; 
            font-size: 32px; 
            font-weight: 800;
            letter-spacing: -1px;
        }
        .header-logo p { margin: 0; color: #6b7280; font-size: 14px; line-height: 1.5; }
        .header-info { text-align: right; }
        .header-info h2 { margin: 0 0 10px 0; font-size: 24px; color: #1f2937; letter-spacing: 2px; }
        .invoice-number { font-size: 16px; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .print-date { font-size: 13px; color: #9ca3af; }
        
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin: 30px 0 15px 0;
            border-left: 4px solid #16a34a;
            padding-left: 10px;
            position: relative;
            z-index: 1;
        }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; position: relative; z-index: 1; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #f3f4f6; text-align: left; font-size: 15px; }
        th { color: #6b7280; font-weight: 600; width: 35%; }
        td { color: #1f2937; font-weight: 500; }
        
        .status-badge { 
            display: inline-block; 
            padding: 6px 16px; 
            border-radius: 9999px; 
            font-size: 13px;
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-badge.paid { background-color: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .status-badge.pending { background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
        .status-badge.accepted { background-color: #dbeafe; color: #2563eb; border: 1px solid #bfdbfe; }
        
        .total-row th, .total-row td {
            border-top: 2px solid #e5e7eb;
            font-size: 18px;
            font-weight: 800;
            padding-top: 20px;
        }
        .total-amount { color: #16a34a; }
        
        .tte-section {
            margin-top: 60px;
            display: flex;
            justify-content: flex-end;
            position: relative;
            z-index: 1;
        }
        .tte-box {
            text-align: center;
            width: 250px;
        }
        .tte-box img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
            border: 2px solid #e5e7eb;
            padding: 5px;
            border-radius: 8px;
        }
        .tte-text {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.4;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .tte-text strong {
            color: #1f2937;
            display: block;
            margin-bottom: 3px;
        }

        .footer { 
            margin-top: 50px; 
            text-align: center; 
            font-size: 13px; 
            color: #9ca3af; 
            position: relative;
            z-index: 1;
        }
        
        .btn-print { 
            display: block; 
            margin: 0 auto 30px auto; 
            padding: 12px 30px; 
            background: #16a34a; 
            color: white; 
            border: none; 
            border-radius: 50px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);
            transition: all 0.2s;
        }
        .btn-print:hover { background: #15803d; transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3); }
        
        @media print {
            .btn-print { display: none; }
            body { padding: 0; background: white; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .invoice-box { border: none; box-shadow: none; padding: 0; border-top: 8px solid #16a34a; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">
        <svg style="width:18px; height:18px; display:inline-block; vertical-align:middle; margin-right:8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        Cetak Dokumen Resmi
    </button>
    
    <div class="invoice-box">
        <div class="watermark">MAAAFIQS MINI SOCCER</div>
        
        <div class="header">
            <div class="header-logo">
                <h1>Maaafiqs Mini Soccer</h1>
                <p>Jl. Stadion Olahraga No. 1, Jakarta Selatan<br>No. Telp: 0777 3333 4444 | Email: info@maaafiqsminisoccer.com</p>
            </div>
            <div class="header-info">
                <h2>BUKTI RESERVASI</h2>
                <div class="invoice-number">INV-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="print-date">Diterbitkan: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</div>
            </div>
        </div>
        
        <div class="section-title">Informasi Pemesan</div>
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $reservation->user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $reservation->user->email }}</td>
            </tr>
            @if($reservation->user->phone)
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $reservation->user->phone }}</td>
            </tr>
            @endif
            <tr>
                <th>Status Pembayaran</th>
                <td>
                    @php
                        $statusClass = 'pending';
                        if($reservation->status == 'dibayar' || $reservation->status == 'selesai') $statusClass = 'paid';
                        if($reservation->status == 'diterima') $statusClass = 'accepted';
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ strtoupper($reservation->status) }}</span>
                </td>
            </tr>
        </table>

        <div class="section-title">Rincian Layanan</div>
        <table>
            <tr>
                <th>Layanan</th>
                <td>
                    Sewa Lapangan Mini Soccer
                    @if($reservation->type === 'event')
                        <br><span style="font-size:13px; color:#16a34a; font-weight:700;">(Acara / Event: {{ $reservation->event_name }})</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tanggal Main</th>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <th>Waktu / Jam</th>
                <td>{{ is_string($reservation->start_time) ? substr($reservation->start_time, 0, 5) : $reservation->start_time->format('H:i') }} WIB - {{ (is_string($reservation->start_time) ? \Carbon\Carbon::parse($reservation->start_time) : clone $reservation->start_time)->addHours($reservation->duration)->format('H:i') }} WIB ({{ $reservation->duration }} Jam)</td>
            </tr>
            <tr>
                <th>Tarif Dasar / Jam</th>
                <td>Rp {{ number_format($reservation->price_per_hour, 0, ',', '.') }}</td>
            </tr>
            @if($reservation->voucher)
            <tr>
                <th>Potongan Harga (Voucher)</th>
                <td style="color: #ef4444;">
                    @if($reservation->voucher->type === 'percent')
                        - {{ floatval($reservation->voucher->discount_amount) }}% (Rp {{ number_format(($reservation->price_per_hour * $reservation->duration) * ($reservation->voucher->discount_amount / 100), 0, ',', '.') }})
                    @else
                        - Rp {{ number_format($reservation->voucher->discount_amount, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @endif
            <tr class="total-row">
                <th>Total Pembayaran</th>
                <td class="total-amount">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Area Tanda Tangan Elektronik -->
        <div class="tte-section">
            <div class="tte-box">
                <!-- Generate Dynamic QR Code based on URL/ID -->
                @php
                    $qrData = urlencode(route('home') . '?verify_inv=INV-' . str_pad($reservation->id, 5, '0', STR_PAD_LEFT));
                @endphp
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $qrData }}&color=16a34a" alt="QR Code TTE">
                <div class="tte-text">
                    <strong>TANDA TANGAN ELEKTRONIK</strong>
                    Dokumen ini sah dan telah divalidasi secara digital oleh Sistem Maaafiqs Mini Soccer pada {{ \Carbon\Carbon::parse($reservation->updated_at)->translatedFormat('d F Y') }}.
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Perhatian:</strong> Harap tunjukkan dokumen ini (cetak atau digital) kepada petugas lapangan 15 menit sebelum waktu bermain.<br>
            Maaafiqs Mini Soccer tidak bertanggung jawab atas keterlambatan waktu mulai yang disebabkan oleh kelalaian penyewa.</p>
        </div>
    </div>
</body>
</html>
