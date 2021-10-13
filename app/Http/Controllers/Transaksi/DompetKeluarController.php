<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DompetKeluarController extends Controller
{
    public function index()
    {
        $data = [
            'title'             =>  'Transaksi | Dompet Keluar',
            'menu'              =>  'Transaksi',
            'submenu'           =>  'Dompet Keluar',
            'breadcrumbTitle'   =>  'Dompet Keluar',
            'breadcrumb'        =>  '<li class="breadcrumb-item active">Transaksi</li>
                                    <li class="breadcrumb-item">
                                        <a href="' . route('transaksi.dompet.keluar') . '">
                                            Dompet Keluar
                                        </a>
                                    </li>',
        ];
        return view('transaksi.dompet-keluar.index', $data);
    }
}
