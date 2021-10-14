@extends('main')
@section('content')
    @include('layouts.alert')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Laporan Transaksi</h3>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="post" id="formLaporan" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Tanggal Awal:</label>
                            <div class="input-group date" id="tanggalAwal" data-target-input="nearest">
                                <div class="input-group-append" data-target="#tanggalAwal" data-toggle="datetimepicker">
                                    <div class="input-group-text"
                                        style="border-top-left-radius: 4px; border-bottom-left-radius:4px"><i
                                            class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" data-target="#tanggalAwal"
                                    name="tanggal_awal"
                                    value="{{ date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d')))) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori:</label>
                            <select class="form-control" name="kategori">
                                <option value="Semua">Semua</option>
                                @foreach ($kategori as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Tanggal Akhir:</label>
                            <div class="input-group date" id="tanggalAkhir" data-target-input="nearest">
                                <div class="input-group-append" data-target="#tanggalAkhir" data-toggle="datetimepicker">
                                    <div class="input-group-text"
                                        style="border-top-left-radius: 4px; border-bottom-left-radius:4px"><i
                                            class="fa fa-calendar"></i></div>
                                </div>
                                <input type="text" class="form-control datetimepicker-input" data-target="#tanggalAkhir"
                                    name="tanggal_akhir" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Dompet</label>
                            <select class="form-control" name="dompet">
                                <option value="Semua">Semua</option>
                                @foreach ($dompet as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Status:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="uangMasuk" name="status[]"
                                    value="Masuk">
                                <label class="form-check-label" for="uangMasuk">Tampilkan Uang Masuk</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="uangKeluar" name="status[]"
                                    value="Keluar">
                                <label class="form-check-label" for="uangKeluar">Tampilkan Uang Keluar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="print" class="btn btn-primary mr-2">Buat Laporan</button>
                <button type="submit" name="excel" class="btn btn-primary">Buat ke Excel</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#formLaporan').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true;
            });

        $('#tanggalAwal').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#tanggalAkhir').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
@endsection
