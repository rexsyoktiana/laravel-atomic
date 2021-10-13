<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DompetController extends Controller
{
    public function index()
    {
        $data = [
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
