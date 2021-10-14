<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Dompet;
use App\Models\DompetStatus;
use Illuminate\Http\Request;

class DompetController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if ($id != null) {
            $checkDompetStatus = DompetStatus::where('id', '=', $id)->first();
            if (empty($checkDompetStatus)) {
                return redirect()->route('master.dompet')->with('error', 'ID Status tidak ditemukan');
            }
        }

        if ($request->method() == "POST") {
            if ($request->has('updateStatus')) {
                $id = $request->post('id');
                $status = $request->post('status');

                $dompetStatus = DompetStatus::where('nama', '=', $status)->first();

                if (empty($dompetStatus)) {
                    return redirect()->route('master.dompet')->with('error', 'Ada masalah dengan id status');
                }

                Dompet::where('id', '=', $id)->update(['status_id' => $dompetStatus->id]);
                return redirect()->route('master.dompet')->with('success', 'Anda berhasil mengupdate status dompet');
            }
        } else {
            $dompet = null;
            $status = null;
            $totalAll = Dompet::all()->count();
            $totalAktif = null;
            $totalTidakAktif = null;
            $totalStatus = null;

            $getStatus = DompetStatus::all();
            foreach ($getStatus as $k => $v) {
                if ($v->nama == 'Aktif') {
                    $totalAktif = Dompet::where('status_id', '=', $v->id)->count();
                } elseif ($v->nama == 'Tidak Aktif') {
                    $totalTidakAktif = Dompet::where('status_id', '=', $v->id)->count();
                }
            }

            if ($id == null) {
                $status = "Semua";
                $dompet = Dompet::with('dompetStatus')->get();
                $totalAll = Dompet::all()->count();
                $totalStatus = $totalAll;
            } else {
                $dompetStatus = DompetStatus::where('id', '=', $id)->first();
                $status = $dompetStatus->nama;
                $dompet = Dompet::with('dompetStatus')->where('status_id', '=', $id)->get();
                $totalStatus = $dompet->count();
            }

            $data = [
                'dompet'            =>  $dompet,
                'totalAll'          =>  $totalAll,
                'totalAktif'        =>  $totalAktif,
                'totalTidakAktif'   =>  $totalTidakAktif,
                'status'            =>  $status,
                'totalStatus'       =>  $totalStatus,
                'dompetStatus'      =>  $getStatus,
                'title'             =>  'Master | Dompet',
                'menu'              =>  'Master',
                'submenu'           =>  'Dompet',
                'breadcrumbTitle'   =>  'Dompet',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.dompet') . '">
                                                Dompet
                                            </a>
                                        </li>',
            ];
            return view('master.dompet.index', $data);
        }
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->has('add')) {
                $request->validate(
                    [
                        'nama'      =>  'required|min:5|max:255',
                        'referensi' =>  'max:20',
                        'deskripsi' =>  'max:100',
                        'status'    =>  'required'
                    ],
                    [
                        'nama.required' =>  'Nama harus terisi',
                        'nama.min'      =>  'Karakter nama minimal :min',
                        'nama.max'      =>  'Maksimal karakter nama hanya :max',
                        'referensi.max'         =>  'Maksimal karakter referensi hanya :max',
                        'deskripsi.max'         =>  'Maksimal karakter deskripsi hanya :max',
                        'status.required'       =>  'Status harus terisi',
                    ]
                );

                $nama       = $request->post('nama');
                $referensi  = $request->post('referensi');
                $deskripsi  = $request->post('deskripsi');
                $status     = $request->post('status');
                if ($referensi != "") {
                    $request->validate(
                        [
                            'referensi' =>  'integer'
                        ],
                        [
                            'referensi.integer' =>  'Karakter referensi hanya boleh angka'
                        ]
                    );
                }

                $checkStatus = DompetStatus::where('id', '=', $status)->first();
                if (empty($checkStatus)) {
                    return redirect()->route('master.dompet.add')->with('error', 'ID Status tidak ditemukan');
                }

                $data = [
                    'nama'          =>  $nama,
                    'referensi'     =>  $referensi,
                    'deskripsi'     =>  $deskripsi,
                    'status_id'        =>  $status
                ];

                Dompet::create($data);
                return redirect()->route('master.dompet')->with('success', 'Anda berhasil menambahkan dompet');
            }
        } else {
            $data = [
                'dompetStatus'      =>  DompetStatus::all(),
                'title'             =>  'Master | Tambah Dompet',
                'menu'              =>  'Master',
                'submenu'           =>  'Dompet',
                'breadcrumbTitle'   =>  'Tambah Dompet',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.dompet') . '">
                                                Dompet
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Tambah</li>',
            ];
            return view('master.dompet.add', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        if ($id != null) {
            $checkDompet = Dompet::where('id', '=', $id)->first();
            if (empty($checkDompet)) {
                return redirect()->route('master.dompet')->with('error', 'ID Dompet tidak ditemukan');
            }
        }

        if ($request->method() == 'POST') {
            if ($request->has('edit')) {
                $request->validate(
                    [
                        'nama'      =>  'required|min:5|max:255',
                        'referensi' =>  'max:20',
                        'deskripsi' =>  'max:100',
                        'status'    =>  'required'
                    ],
                    [
                        'nama.required' =>  'Nama harus terisi',
                        'nama.min'      =>  'Karakter nama minimal :min',
                        'nama.max'      =>  'Maksimal karakter nama hanya :max',
                        'referensi.max'         =>  'Maksimal karakter referensi hanya :max',
                        'deskripsi.max'         =>  'Maksimal karakter deskripsi hanya :max',
                        'status.required'       =>  'Status harus terisi',
                    ]
                );

                $nama       = $request->post('nama');
                $referensi  = $request->post('referensi');
                $deskripsi  = $request->post('deskripsi');
                $status     = $request->post('status');
                if ($referensi != "") {
                    $request->validate(
                        [
                            'referensi' =>  'integer'
                        ],
                        [
                            'referensi.integer' =>  'Karakter referensi hanya boleh angka'
                        ]
                    );
                }

                $checkStatus = DompetStatus::where('id', '=', $status)->first();
                if (empty($checkStatus)) {
                    return redirect()->route('master.dompet.add')->with('error', 'ID Status tidak ditemukan');
                }

                $data = [
                    'nama'          =>  $nama,
                    'referensi'     =>  $referensi,
                    'deskripsi'     =>  $deskripsi,
                    'status_id'     =>  $status
                ];

                Dompet::where('id', '=', $id)->update($data);
                return redirect()->route('master.dompet')->with('success', 'Anda berhasil mengubah dompet');
            }
        } else {
            $data = [
                'dompetStatus'      =>  DompetStatus::all(),
                'dompet'            =>  Dompet::where('id', '=', $id)->first(),
                'title'             =>  'Master | Ubah Dompet',
                'menu'              =>  'Master',
                'submenu'           =>  'Dompet',
                'breadcrumbTitle'   =>  'Ubah Dompet',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.dompet') . '">
                                                Dompet
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Ubah</li>',
            ];
            return view('master.dompet.edit', $data);
        }
    }

    public function detail($id)
    {
        if ($id != null) {
            $checkDompet = Dompet::where('id', '=', $id)->first();
            if (empty($checkDompet)) {
                return redirect()->route('master.dompet')->with('error', 'ID Dompet tidak ditemukan');
            }
        }
        
        $data = [
            'dompetStatus'      =>  DompetStatus::all(),
            'dompet'            =>  Dompet::where('id', '=', $id)->first(),
            'title'             =>  'Master | Detail Dompet',
            'menu'              =>  'Master',
            'submenu'           =>  'Dompet',
            'breadcrumbTitle'   =>  'Detail Dompet',
            'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.dompet') . '">
                                                Dompet
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Detail</li>',
        ];
        return view('master.dompet.detail', $data);
    }
}
