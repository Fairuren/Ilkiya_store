<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Data Pesanan</title>
</head>

<body>

    <div class="">
        <div class="text-center">
            <h3>Laporan Data Pesanan Sukses</h3>
            <div style="display: flex;" class="d-flex">
                <p><span style="font-weight: 900;">Dari Tanggal</span> : {{ $start }} <span
                        style="font-weight: 900;"> Sampai Tanggal</span> : {{ $end }}</p>
            </div>
            {{-- header --}}
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size: 12px;">
                        <th style="border : 1px solid black;">No</th>
                        <th style="border : 1px solid black;">Nama</th>
                        <th style="border : 1px solid black;">Nomor Order</th>
                        <th style="border : 1px solid black;">Jumlah </th>
                        <th style="border : 1px solid black;">Tanggal Pesan</th>
                        <th style="border : 1px solid black;">Tanggal Diterima</th>
                        {{-- <th style="border : 1px solid black;">Harga (Rp.)</th>
                        <th style="border : 1px solid black;">Ongkir (Rp.)</th> --}}
                        <th style="border : 1px solid black;">Total Harga (Rp.)</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $order)
                        <tr style="font-size: 12px;">
                            <td style="border : 1px solid black;">{{ $loop->iteration }}</td>
                            <td style="border : 1px solid black;">{{ $order->first_name }}</td>
                            <td style="border : 1px solid black;font-size: 10px;">{{ $order->order_number }}</td>
                            <td style="border : 1px solid black;text-align : center;">{{ $order->quantity }}</td>
                            <td style="border : 1px solid black;">{{ $order->created_at }}</td>
                            <td style="border : 1px solid black;">{{ $order->updated_at }}</td>
                            {{-- <td style="border : 1px solid black;">{{ number_format($order->total_amount, 2) }}</td>
                            <td style="border : 1px solid black;">{{ number_format($order->ongkir, 2) }}</td> --}}

                            <td style="border : 1px solid black;">{{ number_format($order->total_amount + $order->ongkir, 2) }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- body --}}
        </div>
        <div class="">
            {{-- footer --}}
        </div>
    </div>
</body>

</html>
