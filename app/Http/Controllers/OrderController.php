<?php

namespace App\Http\Controllers;
use App\Models\Orderan;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    function getAktif(Request $request){
        $ordera = DB::table('orderan')->join('users','orderan.petugas','=','users.id')->join('jenislayanan','orderan.idlayanan','=','jenislayanan.idlayanan')->where('orderan.petugas', $request->user()->id)->where('status','<','2')->select('orderan.*','users.name as nama_user','jenislayanan.namalayanan as nama_layanan')->orderBy('tglorder', 'desc')->get();
        return Inertia::render('LayananAktif', [
            'orders' => $ordera
        ]);
    }

    function getTunda(Request $request){
        $ordert = DB::table('orderan')->join('users','orderan.petugas','=','users.id')->join('jenislayanan','orderan.idlayanan','=','jenislayanan.idlayanan')->where('orderan.petugas', $request->user()->id)->where('status',3)->select('orderan.*','users.name as nama_user','jenislayanan.namalayanan as nama_layanan')->orderBy('tglorder', 'desc')->get();
        return Inertia::render('LayananTunda', [
            'orders' => $ordert
        ]);

    }

    function getSelesai(Request $request){
        $ordersl = DB::table('orderan')->join('users','orderan.petugas','=','users.id')->join('jenislayanan','orderan.idlayanan','=','jenislayanan.idlayanan')->where('orderan.petugas', $request->user()->id)->where('status',2)->select('orderan.*','users.name as nama_user','jenislayanan.namalayanan as nama_layanan')->orderBy('tglorder', 'desc')->get();
        return Inertia::render('LayananSelesai', [
            'orders' => $ordersl
        ]);
    }
    function getJmlO(Request $request){
        $user = $request->user();
        $orderOA = Orderan::where('petugas',$user->id)->where('status','1')->count();
        $orderOT = Orderan::where('petugas',$user->id)->where('status','3')->count();
        $orderOS = Orderan::where('petugas',$user->id)->where('status','2')->count();
        return response()->json([
            'aktif' => $orderOA, 
            'tunda' => $orderOT,
            'selesai' => $orderOS
        ]);
    }

    function simpanOrderan(Request $request){
        $filePath = null;

        $customId = $this->generateID();
        $idorder = date("YmdHis").$customId;
        if ($request->hasFile('file_pdf')){
            $file = $request->file('file_pdf');
            $fileName = $idorder;
            $filePath = $file->storeAs('pdf', $fileName, 'public');
        }

        Orderan::create([
            'idorder'      => $idordeer,
            'tglorder'     => date("Y-m-d H:i:s"),
            'idlayanan'    => $request->idlayanan,
            'keluhan'      => $request->keluhan,
            'pemesan'      => $request->pemesan,
            'unit'         => $request->unit,
            'status'       => 0,
            'petugas'      => $request->petugas
        ]);
    }

    function generateID($length = 4) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
