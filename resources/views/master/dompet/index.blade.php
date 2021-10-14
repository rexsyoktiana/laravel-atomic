@extends('main')
@section('content')
    @include('layouts.alert')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet - {{ $status }}</h3>
                </div>
                <div class="col-6 text-right">
                    <div class="btn-group">
                        <a href="{{ route('master.dompet.add') }}">
                            <button type="button" class="btn btn-primary"
                                style="border-top-right-radius: 0px; border-bottom-right-radius:0px">Buat Baru</button>
                        </a>
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            {{ $status }}({{ $totalStatus }})
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('master.dompet') }}">Semua({{ $totalAll }})</a>
                            @foreach ($dompetStatus as $k => $v)
                                @if ($v->nama == 'Aktif')
                                    <a class="dropdown-item"
                                        href="{{ route('master.dompet', $v->id) }}">Aktif({{ $totalAktif }})</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('master.dompet', $v->id) }}">Tidak
                                        Aktif({{ $totalTidakAktif }})</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table-data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAMA</th>
                        <th>REFERENSI</th>
                        <th>DESKRIPSI</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dompet as $k => $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->referensi }}</td>
                            <td>{{ $v->deskripsi }}</td>
                            <td>{{ $v->dompetStatus->nama }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{ route('master.dompet.detail', $v->id) }}">
                                            <i class="fas fa-search mr-2"></i>
                                            Detail
                                        </a>
                                        <a class="dropdown-item" href="{{ route('master.dompet.edit', $v->id) }}">
                                            <i class="fas fa-pencil-alt mr-2"></i>
                                            Ubah
                                        </a>
                                        @if ($v->dompetStatus->nama == 'Aktif')
                                            <form action="" method="post" class="formStatus"
                                                id="{{ $v->id }}formStatus">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <input type="hidden" name="status" value="Tidak Aktif">
                                                <input type="hidden" name="updateStatus">
                                                <button class="dropdown-item" type="submit">
                                                    <i class="fas fa-times mr-2"></i>
                                                    Tidak Aktif
                                                </button>
                                            </form>
                                        @elseif($v->dompetStatus->nama = 'Tidak Aktif')
                                            <form action="" method="post" class="formStatus">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <input type="hidden" name="status" value="Aktif">
                                                <input type="hidden" name="updateStatus">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Aktif
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
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
