<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DompetMasukController extends Controller
{
    public function index()
    {
        $data = [
            'title'             =>  'Transaksi | Dompet Masuk',
            'menu'              =>  'Transaksi',
            'submenu'           =>  'Dompet Masuk',
            'breadcrumbTitle'   =>  'Dompet Masuk',
            'breadcrumb'        =>  '<li class="breadcrumb-item active">Transaksi</li>
                                    <li class="breadcrumb-item">
                                        <a href="' . route('transaksi.dompet.masuk') . '">
                                            Dompet Masuk
                                        </a>
                                    </li>',
        ];
        return view('transaksi.dompet-masuk.index', $data);
    }
}
