<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris Barang</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; margin: 0; padding: 20px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #22c55e; padding-bottom: 20px; }
        .header h1 { margin: 0 0 10px 0; color: #166534; font-size: 24px; }
        .header p { margin: 0; color: #555; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 14px; }
        th, td { border: 1px solid #ddd; padding: 12px 15px; text-align: left; }
        th { background-color: #f8fafc; color: #334155; font-weight: bold; text-transform: uppercase; font-size: 12px; }
        tr:nth-child(even) { background-color: #fdfdfd; }
        .footer { text-align: right; margin-top: 50px; font-size: 14px; }
        .footer p { margin: 5px 0; }
        .signature-area { display: inline-block; text-align: center; margin-top: 20px; }
        .signature-line { margin-top: 70px; border-top: 1px solid #333; width: 200px; display: inline-block; }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
        .btn-print { background: #22c55e; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-bottom: 20px; display: inline-block; }
        .btn-print:hover { background: #16a34a; }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right;">
        <button class="btn-print" onclick="window.print()">&#12843 Cetak Sekarang</button>
    </div>

    <div class="header">
        <h1>Maaafiqs Mini Soccer</h1>
        <p>Laporan Data Inventaris Barang</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
        @if(request()->filled('search') || request()->filled('category') || request()->filled('status'))
            <p style="margin-top: 10px; font-weight: bold; color: #d97706; background: #fef3c7; display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 12px;">* Laporan Berdasarkan Filter Pencarian *</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Kode Barang</th>
                <th style="width: 35%;">Nama Barang / Merk</th>
                <th style="width: 20%;">Kategori</th>
                <th style="text-align: center; width: 10%;">Jumlah</th>
                <th style="text-align: center; width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-family: monospace;">{{ $item->item_code }}</td>
                    <td>
                        <strong>{{ $item->name }}</strong>
                        @if($item->brand) <br><span style="font-size: 12px; color: #666;">Merk: {{ $item->brand }}</span> @endif
                    </td>
                    <td>{{ $item->category->name ?? '-' }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $item->quantity }}</td>
                    <td style="text-align: center;">{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px;">Tidak ada data barang untuk dicetak.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-area">
            <p>Admin Maaafiqs Mini Soccer,</p>
            <div class="signature-line"></div>
            <p style="margin-top: 5px;">{{ Auth::user()->name }}</p>
        </div>
    </div>

    <script>
        // Auto print on load
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
