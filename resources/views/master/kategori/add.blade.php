@extends('main')
@section('content')


    @include('layouts.alert')
    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Kategori - <small>Buat Baru</small></h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('master.kategori') }}">
                        <button class="btn btn-primary">Kelola Kategori</button>
                    </a>
                </div>
            </div>
        </div>
        <form action="" method="post" id="formKategori" data-parsley-validate="">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                        aria-describedby="messageNama" value="" required
                        data-parsley-required-message="Nama harus terisi">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"
                        aria-describedby="messageDeskripsi" data-parsley-maxlength="100"
                        data-parsley-maxlength-message="Maksimal karakter deskripsi hanya 100"></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status" aria-describedby="messageSatatus">
                        @foreach ($kategoriStatus as $k => $v)
                            <option value="{{ $v->id }}">
                                {{ $v->nama }}</option>
                        @endforeach
                    </select>
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
