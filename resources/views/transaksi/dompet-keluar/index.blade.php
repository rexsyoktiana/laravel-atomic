@extends('main')
@section('content')
    @include('layouts.alert')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Dompet Keluar - Status</h3>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table-data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td>5.5</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 6
                        </td>
                        <td>Win 98+</td>
                        <td>6</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet Explorer 7</td>
                        <td>Win XP SP2+</td>
                        <td>7</td>
                        <td>A</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
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
