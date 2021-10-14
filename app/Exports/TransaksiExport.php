<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\TransaksiStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Transaksi::all();
    // }

    protected $request;
    function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {

        $tanggal_awal   = $this->request->post('tanggal_awal');
        $tanggal_akhir  = $this->request->post('tanggal_akhir');
        $status         = $this->request->post('status');
        $kategori       = $this->request->post('kategori');
        $dompet         = $this->request->post('dompet');

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

        return view('laporan.laporan-transaksi.export', [
            'transaksi' => $transaksi,
            'tanggal'   =>  $tanggal_awal . " " . $tanggal_akhir

        ]);
    }
}
