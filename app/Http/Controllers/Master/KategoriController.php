<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KategoriStatus;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index(Request $request, $id = null)
    {
        if ($id != null) {
            $checkKategoriStatus = KategoriStatus::where('id', '=', $id)->first();
            if (empty($checkKategoriStatus)) {
                return redirect()->route('master.kategori')->with('error', 'ID Status tidak ditemukan');
            }
        }

        if ($request->method() == "POST") {
            if ($request->has('updateStatus')) {
                $id = $request->post('id');
                $status = $request->post('status');

                $kategoriStatus = KategoriStatus::where('nama', '=', $status)->first();

                if (empty($kategoriStatus)) {
                    return redirect()->route('master.kategori')->with('error', 'Ada masalah dengan id status');
                }

                Kategori::where('id', '=', $id)->update(['status_id' => $kategoriStatus->id]);
                return redirect()->route('master.kategori')->with('success', 'Anda berhasil mengupdate status kategori');
            }
        } else {
            $kategori = null;
            $status = null;
            $totalAll = Kategori::all()->count();
            $totalAktif = null;
            $totalTidakAktif = null;
            $totalStatus = null;

            $getStatus = KategoriStatus::all();
            foreach ($getStatus as $k => $v) {
                if ($v->nama == 'Aktif') {
                    $totalAktif = Kategori::where('status_id', '=', $v->id)->count();
                } elseif ($v->nama == 'Tidak Aktif') {
                    $totalTidakAktif = Kategori::where('status_id', '=', $v->id)->count();
                }
            }

            if ($id == null) {
                $status = "Semua";
                $kategori = Kategori::with('kategoriStatus')->get();
                $totalAll = Kategori::all()->count();
                $totalStatus = $totalAll;
            } else {
                $kategoriStatus = KategoriStatus::where('id', '=', $id)->first();
                $status = $kategoriStatus->nama;
                $kategori = Kategori::with('kategoriStatus')->where('status_id', '=', $id)->get();
                $totalStatus = $kategori->count();
            }

            $data = [
                'kategori'          =>  $kategori,
                'totalAll'          =>  $totalAll,
                'totalAktif'        =>  $totalAktif,
                'totalTidakAktif'   =>  $totalTidakAktif,
                'status'            =>  $status,
                'totalStatus'       =>  $totalStatus,
                'kategoriStatus'    =>  $getStatus,
                'title'             =>  'Master | Kategori',
                'menu'              =>  'Master',
                'submenu'           =>  'Kategori',
                'breadcrumbTitle'   =>  'Kategori',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                    <li class="breadcrumb-item">
                                        <a href="' . route('master.kategori') . '">
                                            Kategori
                                        </a>
                                    </li>',
            ];
            return view('master.kategori.index', $data);
        }
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->has('add')) {
                $request->validate(
                    [
                        'nama'      =>  'required|min:5|max:255',
                        'deskripsi' =>  'max:100',
                        'status'    =>  'required'
                    ],
                    [
                        'nama.required' =>  'Nama harus terisi',
                        'nama.min'      =>  'Karakter nama minimal :min',
                        'nama.max'      =>  'Maksimal karakter nama hanya :max',
                        'deskripsi'     =>  'Maksimal karakter deskripsi hanya :max',
                        'status.required'       =>  'Status harus terisi',
                    ]
                );

                $nama       = $request->post('nama');
                $deskripsi  = $request->post('deskripsi');
                $status     = $request->post('status');

                $checkStatus = KategoriStatus::where('id', '=', $status)->first();
                if (empty($checkStatus)) {
                    return redirect()->route('master.kategori.add')->with('error', 'ID Status tidak ditemukan');
                }

                $data = [
                    'nama'          =>  $nama,
                    'deskripsi'     =>  $deskripsi,
                    'status_id'     =>  $status
                ];

                Kategori::create($data);
                return redirect()->route('master.kategori')->with('success', 'Anda berhasil menambahkan kategori');
            }
        } else {
            $data = [
                'kategoriStatus'    =>  KategoriStatus::all(),
                'title'             =>  'Master | Tambah Kategori',
                'menu'              =>  'Master',
                'submenu'           =>  'Kategori',
                'breadcrumbTitle'   =>  'Tambah Kategori',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.kategori') . '">
                                                Kategori
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Tambah</li>',
            ];
            return view('master.kategori.add', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        if ($id != null) {
            $checkKategori = Kategori::where('id', '=', $id)->first();
            if (empty($checkKategori)) {
                return redirect()->route('master.kategori')->with('error', 'ID Kategori tidak ditemukan');
            }
        }


        if ($request->method() == 'POST') {
            if ($request->has('edit')) {
                $request->validate(
                    [
                        'nama'      =>  'required|min:5|max:255',
                        'deskripsi' =>  'max:100',
                        'status'    =>  'required'
                    ],
                    [
                        'nama.required' =>  'Nama harus terisi',
                        'nama.min'      =>  'Karakter nama minimal :min',
                        'nama.max'      =>  'Maksimal karakter nama hanya :max',
                        'deskripsi.max'         =>  'Maksimal karakter deskripsi hanya :max',
                        'status.required'       =>  'Status harus terisi',
                    ]
                );

                $nama       = $request->post('nama');
                $deskripsi  = $request->post('deskripsi');
                $status     = $request->post('status');

                $checkStatus = KategoriStatus::where('id', '=', $status)->first();
                if (empty($checkStatus)) {
                    return redirect()->route('master.kategori.add')->with('error', 'ID Status tidak ditemukan');
                }

                $data = [
                    'nama'          =>  $nama,
                    'deskripsi'     =>  $deskripsi,
                    'status_id'     =>  $status
                ];

                Kategori::where('id', '=', $id)->update($data);
                return redirect()->route('master.kategori')->with('success', 'Anda berhasil mengubah kategori');
            }
        } else {
            $data = [
                'kategoriStatus'      =>  KategoriStatus::all(),
                'kategori'            =>  Kategori::where('id', '=', $id)->first(),
                'title'             =>  'Master | Ubah Kategori',
                'menu'              =>  'Master',
                'submenu'           =>  'Kategori',
                'breadcrumbTitle'   =>  'Ubah Kategori',
                'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.kategori') . '">
                                                Kategori
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Ubah</li>',
            ];
            return view('master.kategori.edit', $data);
        }
    }

    public function detail($id)
    {
        if ($id != null) {
            $checkKategori = Kategori::where('id', '=', $id)->first();
            if (empty($checkKategori)) {
                return redirect()->route('master.kategori')->with('error', 'ID Kategori tidak ditemukan');
            }
        }

        $data = [
            'kategoriStatus'    =>  KategoriStatus::all(),
            'kategori'          =>  Kategori::where('id', '=', $id)->first(),
            'title'             =>  'Master | Detail Kategori',
            'menu'              =>  'Master',
            'submenu'           =>  'Kategori',
            'breadcrumbTitle'   =>  'Detail Kategori',
            'breadcrumb'        =>  '<li class="breadcrumb-item active">Master</li>
                                        <li class="breadcrumb-item">
                                            <a href="' . route('master.kategori') . '">
                                                Kategori
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item active">Detail</li>',
        ];
        return view('master.kategori.detail', $data);
    }
}
