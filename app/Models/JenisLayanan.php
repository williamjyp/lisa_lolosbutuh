<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisLayanan extends Model
{
    use HasFactory;
    protected $table = 'jenislayanan';
    protected $fillable = [
       'namalayanan',
       'iduser',
       'status_tampil'
    ];
}
