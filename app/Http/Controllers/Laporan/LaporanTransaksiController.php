<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        $data = [
            'title'             =>  'Laporan | Laporan Transaksi',
            'menu'              =>  'Laporan',
            'submenu'           =>  'Laporan Transaksi',
            'breadcrumbTitle'   =>  'Laporan Transaksi',
            'breadcrumb'        =>  '<li class="breadcrumb-item active">Laporan</li>
                                    <li class="breadcrumb-item">
                                        <a href="' . route('laporan.transaksi') . '">
                                            Laporan Transaksi
                                        </a>
                                    </li>',
        ];
        return view('laporan.laporan-transaksi.index', $data);
    }
}
