@extends('main')
@section('content')


    @include('layouts.alert')
    <div class="card mb-5">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet - <small>Detail</small></h3>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('master.dompet') }}">
                        <button class="btn btn-primary">Kelola Dompet</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input disabled type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                            aria-describedby="messageNama" required data-parsley-required-message="Nama harus terisi"
                            value="{{ $dompet->nama ?? '' }}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="referensi">Referensi</label>
                        <input disabled type="text" name="referensi" id="referensi" class="form-control" placeholder="Referensi"
                            aria-describedby="messageReferensi" data-parsley-maxlength="20"
                            data-parsley-maxlength-message="Maksimal karakter referensi hanya 20"
                            data-parsley-type="integer" data-parsley-type-message="Hanya boleh karakter angka"
                            value="{{ $dompet->referensi ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea disabled name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"
                    aria-describedby="messageDeskripsi" data-parsley-maxlength="100"
                    data-parsley-maxlength-message="Maksimal karakter deskripsi hanya 100">{{ $dompet->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select disabled class="form-control" name="status" id="status" aria-describedby="messageSatatus">
                    @foreach ($dompetStatus as $k => $v)
                        <option value="{{ $v->id }}" {{ $dompet->status_id == $v->id ? 'selected' : '' }}>
                            {{ $v->nama }}</option>
                    @endforeach
                </select>
                <small id="messageDeskripsi" class="text-muted"></small>
            </div>
            <input type="hidden" name="edit" value="edit">
        </div>
    </div>
@endsection
