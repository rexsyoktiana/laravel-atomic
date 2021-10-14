<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        @media print {
            table {
                page-break-inside: auto
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto
            }

            td {
                page-break-inside: avoid;
                page-break-after: auto
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }


        #tableData,
        #tableData th,
        #tableData td {
            /* border: 1px solid black; */
            border-collapse: collapse;
            padding: 5px;
        }

        .border-1 {
            /* border: 1px solid black; */
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div class="col-12">
        <h2 class="text-center">Riwayat Transaksi</h2>
        <h5 class="text-center">{{ $tanggal }}</h5>
        <table class="mt-5" style="width: 100%" id="tableData">
            <thead>
                <tr>
                    <th class="border-1">#</th>
                    <th class="border-1">TANGGAL</th>
                    <th class="border-1">KODE</th>
                    <th class="border-1">DESKRIPSI</th>
                    <th class="border-1">DOMPET</th>
                    <th class="border-1">KATEGORI</th>
                    <th class="border-1">NILAI</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $uangMasuk = 0;
                    $uangKeluar = 0;
                @endphp
                @foreach ($transaksi as $k => $v)
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="border-1" style="word-break:break-all;">{{ $loop->iteration }}</td>
                            <td class="border-1" style="word-break:break-all;">{{ $v->tanggal }}</td>
                            <td class="border-1" style="word-break:break-all;">{{ $v->kode }}</td>
                            <td class="border-1" style="word-break:break-all;">{{ $v->deskripsi }}</td>
                            <td class="border-1" style="word-break:break-all;">{{ $v->dompet->nama }}</td>
                            <td class="border-1" style="word-break:break-all;">{{ $v->kategori->nama }}</td>
                            @if ($v->transaksiStatus->nama == 'Masuk')
                                <td class="border-1 text-right" style="word-break:break-all;">
                                    +({{ number_format($v->nilai, 0, ',', '.') }})</td>
                                @php
                                    $uangMasuk += $v->nilai;
                                @endphp
                            @else
                                <td class="border-1 text-right" style="word-break:break-all;">
                                    -({{ number_format($v->nilai, 0, ',', '.') }})</td>
                                @php
                                    $uangKeluar += $v->nilai;
                                @endphp
                            @endif
                        </tr>
                    @endfor
                @endforeach
                <tr>
                    <td class="text-right border-1" colspan="6">Total Uang Masuk</td>
                    <td class="border-1 text-right">{{ number_format($uangMasuk, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-right border-1" colspan="6">Total Uang Keluar</td>
                    <td class="border-1 text-right">{{ number_format($uangKeluar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-right border-1" colspan="6">Total</td>
                    <td class="border-1 text-right">{{ number_format($uangMasuk - $uangKeluar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="6" style="border-top: 1px solid black"></td>
                    <td style="border-top: 1px solid black"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        window.print();
    </script>
</body>

</html>
