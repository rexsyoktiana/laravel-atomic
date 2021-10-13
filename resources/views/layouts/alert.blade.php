@if ($errors->any())
    <div class="alert alert-danger">
        <h5>Gagal</h5>
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::get('success'))
    <div class="alert alert-success">
        <h5>Berhasil</h5>
        <ul class="m-0">
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@elseif (Session::get('error'))
    <div class="alert alert-danger">
        <h5>Gagal</h5>
        <ul class="m-0">
            <li>{{ Session::get('error') }}</li>
        </ul>
    </div>
@endif
