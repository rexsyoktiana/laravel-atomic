<?php

namespace App\Http\Controllers\Laporan;

use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use App\Models\Dompet;
use App\Models\DompetStatus;
use App\Models\Kategori;
use App\Models\KategoriStatus;
use App\Models\Transaksi;
use App\Models\TransaksiStatus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == "POST") {
            if ($request->has('print')) {
                $request->validate(
                    [
                        'tanggal_awal'  =>  'required',
                        'tanggal_akhir' =>  'required',
                        'status'        =>  'required',
                        'kategori'      =>  'required',
                        'dompet'        =>  'required'
                    ],
                    [
                        'tanggal_awal.required' =>  'Tanggal awal harus terisi',
                        'tanggal_akhir.required'    =>  'Tanggal akhir harus terisi',
                        'status.required'           =>  'Status harus terisi',
                        'kategori.required'         =>  'Kategori harus terisi',
                        'dompet'                    =>  'Dompet harus terisi'
                    ]
                );

                $tanggal_awal   = $request->post('tanggal_awal');
                $tanggal_akhir  = $request->post('tanggal_akhir');
                $status         = $request->post('status');
                $kategori       = $request->post('kategori');
                $dompet         = $request->post('dompet');

                $totalStatus = count($status);
                if ($totalStatus == 2) {
                    $status = "Semua";
                } else {
                    $status = $status[0];
                    $transaksiStatus = TransaksiStatus::where('nama', '=', $status)->first();
                }

                $transaksi = null;
                if ($status == "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->get();
                } else {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('status_id', '=', $transaksiStatus->id)->get();
                }

                if ($status == "Semua" && $kategori == "Semua" && $dompet == "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->get();
                } elseif ($status != "Semua" && $kategori == "Semua" && $dompet == "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('status_id', '=', $transaksiStatus->id)->get();
                } elseif ($status != "Semua" && $kategori != "Semua" && $dompet == "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('status_id', '=', $transaksiStatus->id)->where('kategori_id', '=', $kategori)->get();
                } elseif ($status != "Semua" && $kategori == "Semua" && $dompet != "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('status_id', '=', $transaksiStatus->id)->where('dompet_id', '=', $dompet)->get();
                } elseif ($status == "Semua" && $kategori != "Semua" && $dompet != "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('kategori_id', '=', $kategori)->where('dompet_id', '=', $dompet)->get();
                } elseif ($status != "Semua" && $kategori != "Semua" && $dompet != "Semua") {
                    $transaksi = Transaksi::whereDate('tanggal', '>=', $tanggal_awal)->whereDate('tanggal', '<=', $tanggal_akhir)->where('status_id', '=', $transaksiStatus->id)->where('kategori_id', '=', $kategori)->where('dompet_id', '=', $dompet)->get();
                }

                $data = [
                    'transaksi' =>  $transaksi,
                    'tanggal'   =>  $tanggal_awal . " " . $tanggal_akhir
                ];
                return view('laporan.laporan-transaksi.result', $data);
            }
            if ($request->has('excel')) {
                $request->validate(
                    [
                        'tanggal_awal'  =>  'required',
                        'tanggal_akhir' =>  'required',
                        'status'        =>  'required',
                        'kategori'      =>  'required',
                        'dompet'        =>  'required'
                    ],
                    [
                        'tanggal_awal.required' =>  'Tanggal awal harus terisi',
                        'tanggal_akhir.required'    =>  'Tanggal akhir harus terisi',
                        'status.required'           =>  'Status harus terisi',
                        'kategori.required'         =>  'Kategori harus terisi',
                        'dompet'                    =>  'Dompet harus terisi'
                    ]
                );

                return Excel::download(new TransaksiExport($request), 'Laporan.xlsx');
            }
        } else {
            $kategoriStatus = KategoriStatus::where('nama', '=', 'Aktif')->first();
            $dompetStatus   = DompetStatus::where('nama', '=', 'Aktif')->first();
            $data = [
                'kategori'          =>  Kategori::where('status_id', '=', $kategoriStatus->id)->orderBy('nama', 'ASC')->get(),
                'dompet'            =>  Dompet::where('status_id', '=', $dompetStatus->id)->orderBy('nama', 'ASC')->get(),
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
}
