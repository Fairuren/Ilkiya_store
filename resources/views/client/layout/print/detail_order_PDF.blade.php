<!DOCTYPE html>
<html>

<head>
    <title>Detail Pesanan
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div>
        <div style="margin-bottom : 3rem;" class="text-center">
            <h3 style='text-decoration: underline;'>Laporan Data Detail Pesanan</h3>

            {{-- header --}}

        </div>
        <table class="table">
            <tr class="">
                <td>Nama</td>
                <td> : {{ $order->first_name }} {{ $order->last_name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td> : {{ $order->email }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td> : {{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : {{ $order->address }}</td>
            </tr>
            <tr>
                <td>Kota</td>
                <td> : {{ $order->city }}</td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td> : {{ $order->post_code }}</td>
            </tr>
            <tr class="">
                <td>Nomor Pembelian</td>
                <td> : {{ $order->order_number }}</td>
            </tr>
            <tr>
                <td>Tanggal Pembelian</td>
                <td> : {{ $order->created_at->format('D d M, Y') }} at
                    {{ $order->created_at->format('g : i a') }} </td>
            </tr>
            <tr>
                <td>Jumlah Pembelian</td>
                <td> : {{ $order->quantity }}</td>
            </tr>
            <tr>
                <td>Status Pembelian</td>
                <td> : {{ $order->status }}</td>
            </tr>
            <tr>
                <td>Ongkir</td>
                <td> : Rp. {{ number_format($order->ongkir, 2) }}</td>
            </tr>

            <tr>
                <td>Total Jumlah Pembelian</td>
                <td> : Rp. {{ number_format($order->total_amount, 2) }}</td>
            </tr>

            <tr>
                <td>Bukti Transfer
                    :
                <td> <img style="min-height: 40rem;" src="{{ asset('/storage/' . $order->transfer_evidence) }}"
                        class="img-fluid zoom" style="max-width:80px" alt="{{ 'Gambar' }}"></td>
            </tr>

        </table>
    </div>
</body>

</html>
