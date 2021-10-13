<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
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
