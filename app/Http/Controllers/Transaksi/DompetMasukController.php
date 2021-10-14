<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Dompet;
use App\Models\DompetStatus;
use App\Models\Kategori;
use App\Models\KategoriStatus;
use App\Models\Transaksi;
use App\Models\TransaksiStatus;
use Illuminate\Http\Request;

class DompetMasukController extends Controller
{

    public function index(Request $request)
    {
        $transaksiStatus = TransaksiStatus::where('nama', '=', 'Masuk')->first();
        $data = [
            'transaksi'          =>  Transaksi::with(['dompet', 'kategori'])->where('status_id', '=', $transaksiStatus->id)->get(),
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

    public function add(Request $request)
    {
        $getIdStatus    = TransaksiStatus::where('nama', '=', 'Masuk')->first();
        $getTransaksi   = Transaksi::where('status_id', '=', $getIdStatus->id)->orderBy('id', 'DESC')->first();

        if ($request->method() == 'POST') {
            if ($request->has('add')) {
                $request->validate(
                    [
                        'kode_hidden'       =>  'required',
                        'tanggal_hidden'    =>  'required',
                        'kategori'          =>  'required',
                        'dompet'            =>  'required',
                        'nilai'             =>  'required|integer|min:10000',
                        'deskripsi'         =>  'max:100',
                    ],
                    [
                        'kode_hidden.required'          =>  'Kode harus terisi',
                        'tanggal_hidden.required'       =>  'Tanggal harus terisi',
                        'kategori.required'             =>  'Kategori harus terisi',
                        'dompet.required'               =>  'Dompet harus terisi',
                        'nilai.required'                =>  'Nilai harus terisi',
                        'nilai.integer'                 =>  'Nilai harus integer',
                        'nilai.min'                     =>  'Nilai minimal harus :min',
                    ]
                );

                $kode = $request->post('kode_hidden');
                $tanggal = $request->post('tanggal_hidden');
                $kategori = $request->post('kategori');
                $dompet = $request->post('dompet');
                $nilai = $request->post('nilai');
                $deskripsi = $request->post('deskripsi');

                $checkKategori = Kategori::where('id', '=', $kategori)->first();
                if (empty($checkKategori)) {
                    return redirect()->route('transaksi.dompet.masuk.add')->with('error', 'ID Kategori tidak ditemukan');
                }

                $checkDompet = Dompet::where('id', '=', $dompet)->first();
                if (empty($checkDompet)) {
                    return redirect()->route('transaksi.dompet.masuk.add')->with('error', 'ID Dompet tidak ditemukan');
                }

                $data = [
                    'kode'          =>  $kode,
                    'tanggal'       =>  $tanggal,
                    'kategori_id'   =>  $kategori,
                    'dompet_id'     =>  $dompet,
                    'nilai'     =>  $nilai,
                    'deskripsi' =>  $deskripsi,
                    'status_id' =>  $getIdStatus->id,
                ];

                Transaksi::create($data);
                return redirect()->route('transaksi.dompet.masuk')->with('success', 'Anda berhasil menambahkan transaksi dompet masuk');
            }
        } else {
            $kode = null;
            if (empty($getTransaksi)) {
                $kode = "WIN000001";
            } else {
                $kode = (int)(str_replace('WIN', '', $getTransaksi->kode));
                $kode += 1;
                $kodeLength = strlen($kode);
                for ($i = $kodeLength; $i < 6; $i++) {
                    $kode = "0" . $kode;
                }
                $kode = "WIN" . $kode;
            }

            $kategoriStatus = KategoriStatus::where('nama', '=', 'Aktif')->first();
            $dompetStatus   = DompetStatus::where('nama', '=', 'Aktif')->first();

            $data = [
                'kode'              =>  $kode,
                'kategori'          =>  Kategori::where('status_id', '=', $kategoriStatus->id)->orderBy('nama', 'ASC')->get(),
                'dompet'            =>  Dompet::where('status_id', '=', $dompetStatus->id)->orderBy('nama', 'ASC')->get(),
                'title'             =>  'Transaksi | Dompet Masuk',
                'menu'              =>  'Transaksi',
                'submenu'           =>  'Dompet Masuk',
                'breadcrumbTitle'   =>  'Dompet Masuk',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Transaksi</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('transaksi.dompet.masuk') . '">
                                                Dompet Masuk
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Tambah</li>',
            ];
            return view('transaksi.dompet-masuk.add', $data);
        }
    }
}
