<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSimpan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_simpan';

    protected $primaryKey = 'id_simpanan';

    protected $fillable = 
    [
        'id_simpanan',
        'id_anggota',
        'tanggal',
        'jumlah',
        'bukti_transfer',
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class,'id_anggota');
    }

}
