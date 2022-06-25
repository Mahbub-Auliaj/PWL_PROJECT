<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $primaryKey = 'id_anggota';

    protected $fillable = 
    [
        'id_anggota',
        'nama',
        'alamat',
        'tahun_bergabung',
        'saldo'
    ];

    public function transaksi_pinjam(){
        return $this->hasOne(TransaksiPinjam::class);
    }

    public function transaksi_simpan(){
        return $this->hasOne(TransaksiSimpan::class);
    }



}
