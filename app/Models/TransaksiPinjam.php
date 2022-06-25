<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPinjam extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pinjam';

    protected $primaryKey = 'id_pinjaman';

    protected $fillable = 
    [
        'id_pinjaman',
        'id_anggota',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah',
        'lunas',
    ];

    public function anggota(){
        return $this->belongsTo(Anggota::class,'id_anggota');
    }

}
