<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk PO-{{ str_pad($preOrder->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .ticket {
            width: 58mm;
            /* Ukuran kertas struk thermal standar */
            max-width: 58mm;
            margin: 0 auto;
            padding: 10px;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        td,
        th {
            padding: 2px 0;
            font-size: 13px;
        }

        .border-top {
            border-top: 1px dashed #000;
        }

        .border-bottom {
            border-bottom: 1px dashed #000;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="centered">
            <h2 style="margin: 0;">LOKOMART</h2>
            <p style="margin: 5px 0; font-size:12px;">
                Perum Permata Padalarang D No.23<br>
                Desa Jayamekar, Kab. Bandung Barat<br>
                Telp: +62 815-6462-4079
            </p>
        </div>
        <div class="border-top border-bottom" style="margin: 10px 0;"></div>

        <table>
            <tr>
                <td class="text-left">No. PO</td>
                <td class="text-right">: PO-{{ str_pad($preOrder->id, 4, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="text-left">Tanggal</td>
                <td class="text-right">: {{ \Carbon\Carbon::parse($preOrder->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td class="text-left">Pelanggan</td>
                <td class="text-right">: {{ substr($preOrder->customer_name, 0, 12) }}</td>
            </tr>
            <tr>
                <td class="text-left">Tgl Kirim</td>
                <td class="text-right">: {{ \Carbon\Carbon::parse($preOrder->delivery_date)->format('d/m/Y') }}</td>
            </tr>
        </table>

        <div class="border-top" style="margin: 10px 0;"></div>

        <table>
            <thead>
                <tr>
                    <th class="text-left border-bottom">Item</th>
                    <th class="text-right border-bottom">Qty</th>
                    <th class="text-right border-bottom">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($preOrder->items as $item)
                    <tr>
                        <td class="text-left" colspan="3">{{ $item->food->nama_makanan ?? 'Menu Dihapus' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">x{{ $item->quantity }}</td>
                        <td class="text-right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="border-top" style="margin: 10px 0;"></div>

        <table>
            <tr>
                <td class="text-left bold">TOTAL BAYAR</td>
                <td class="text-right bold">Rp {{ number_format($preOrder->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-left">Status</td>
                <td class="text-right">{{ strtoupper($preOrder->status) }}</td>
            </tr>
            <tr>
                <td class="text-left">Pembayaran</td>
                <td class="text-right">{{ strtoupper($preOrder->payment_method) }}</td>
            </tr>
        </table>

        <div class="border-top border-bottom" style="margin: 10px 0;"></div>

        <div class="centered">
            <p style="margin: 5px 0;">Terima kasih atas pesanan Anda!</p>
            <p style="margin: 5px 0; font-size:11px;">Struk ini merupakan bukti pembayaran pre-order yang sah.</p>
        </div>

        <div class="hidden-print centered" style="margin-top: 20px;">
            <button onclick="window.print()"
                style="padding: 10px 20px; cursor: pointer; background: #0d6efd; color: white; border: none; border-radius: 5px;">Print
                Ulang</button>
            <button onclick="window.close()"
                style="padding: 10px 20px; cursor: pointer; background: #6c757d; color: white; border: none; border-radius: 5px;">Tutup</button>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
