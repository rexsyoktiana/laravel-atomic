@extends('main')
@section('content')
    @include('layouts.alert')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet Masuk</h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('transaksi.dompet.masuk.add') }}">
                        <button class="btn btn-primary">Buat Baru</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table-data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>TANGGAL</th>
                        <th>KODE</th>
                        <th>DESKRIPSI</th>
                        <th>KATEGORI</th>
                        <th>NILAI</th>
                        <th>DOMPET</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $k => $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->tanggal }}</td>
                            <td>{{ $v->kode }}</td>
                            <td>{{ $v->deskripsi }}</td>
                            <td>{{ $v->kategori->nama }}</td>
                            <td>(+) {{ number_format($v->nilai, 0, '.', ',') }}</td>
                            <td>{{ $v->dompet->nama }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#table-data').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endsection
