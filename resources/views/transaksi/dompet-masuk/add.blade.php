@extends('main')
@section('content')


    @include('layouts.alert')
    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet Masuk - <small>Buat Baru</small></h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('transaksi.dompet.masuk') }}">
                        <button class="btn btn-primary">Kelola Dompet Masuk</button>
                    </a>
                </div>
            </div>
        </div>
        <form action="" method="post" id="formKategori" data-parsley-validate="">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">

                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input readonly type="text" name="kode" id="kode" class="form-control" placeholder="Kode"
                                required data-parsley-required-message="Kode harus terisi" value="{{ $kode }}">
                        </div>
                        <input type="hidden" name="kode_hidden" value="{{ $kode }}">
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input readonly type="text" name="tanggal" id="tanggal" class="form-control"
                                placeholder="Tanggal" value="{{ date('Y-m-d') }}" required
                                data-parsley-required-message="Tanggal harus terisi">
                        </div>
                        <input type="hidden" name="tanggal_hidden" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori" id="kategori">
                                @foreach ($kategori as $k => $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="dompet">Dompet</label>
                            <select class="form-control" name="dompet" id="dompet">
                                @foreach ($dompet as $k => $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai"
                        data-parsley-type="integer" data-parsley-type-message="Karakter nilai hanya boleh angka" data-parsley-min="10000" data-parsley-min-message="Minimal nilai harus 10000">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"
                        aria-describedby="messageDeskripsi" data-parsley-maxlength="100"
                        data-parsley-maxlength-message="Maksimal karakter deskripsi hanya 100"></textarea>
                </div>

                <input type="hidden" name="add" value="add">
                <button class="btn btn-primary" type="submit" id="btnSubmit">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#formKategori').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true;
            });
    </script>
@endsection
