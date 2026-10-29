<?php

namespace App\Http\Controllers;
use App\Models\JenisLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    function getJenisLayanan(){
        $jenisl = DB::table('jenislayanan')->join('users','jenislayanan.iduser','=','users.id')->where('jenislayanan.status_tampil', 1)->select('jenislayanan.*','users.name as nama_user')->get();
        return response()->json($jenisl);
    }
}
