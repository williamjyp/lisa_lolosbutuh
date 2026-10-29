<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{

    protected $table = 'orderan';
    protected $fillable = [
       'idorder',
       'tglorder',
       'idlayanan',
       'keluhan',
       'file_nama',
       'pemesan',
       'unit',
       'status',
       'tglstatus',
       'alasan',
       'catatan_internal',
       'file_hasil',
       'petugas',
       'nilai',
       'komentar'
    ];
}
