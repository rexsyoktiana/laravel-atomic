@extends('main')
@section('content')


    @include('layouts.alert')
    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet - <small>Buat Baru</small></h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('master.dompet') }}">
                        <button class="btn btn-primary">Kelola Dompet</button>
                    </a>
                </div>
            </div>
        </div>
        <form action="" method="post" id="formDompet" data-parsley-validate="">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                                aria-describedby="messageNama" required data-parsley-required-message="Nama harus terisi">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="referensi">Referensi</label>
                            <input type="text" name="referensi" id="referensi" class="form-control"
                                placeholder="Referensi" aria-describedby="messageReferensi" data-parsley-maxlength="20"
                                data-parsley-maxlength-message="Maksimal karakter referensi hanya 20"
                                data-parsley-type="integer" data-parsley-type-message="Hanya boleh karakter angka">
                        </div>
                    </div>
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
                        @foreach ($dompetStatus as $k => $v)
                            <option value="{{ $v->id }}">
                                {{ $v->nama }}</option>
                        @endforeach
                    </select>
                    <small id="messageDeskripsi" class="text-muted"></small>
                </div>
                <input type="hidden" name="add" value="add">
                <button class="btn btn-primary" type="submit" id="btnSubmit">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#formDompet').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true;
            });
    </script>
@endsection
