<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\TransaksiPinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //yang semulanya Mahasiswa::all menjadi mahasiswa with yang menyatakan relasi
         $transaksi_pinjam = TransaksiPinjam::with('anggota')->get();
    
         // fungsi latest berfungsi untuk menampilkan berdasarkan data terakhir di input    
         $post = TransaksiPinjam::latest();
         // search berdasarkan nama atau nim
         if (request('search')) {
             $post->where('id_pinjaman', 'like', '%' . request('search') . '%')->orWhere('jumlah','like','%' . request('search').'%');
         }
 
         //add pagination 
         return view('Pinjam.index',[
             'transaksi_pinjam' => $transaksi_pinjam,
             'post' => $post -> paginate (5)
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota=Anggota::all(); //mendapatkan data dari tabel kelas
        return view('Pinjam.create',['anggota'=>$anggota]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'id_pinjaman'=>'required',
            'id_anggota'=>'required',
            'tanggal_pinjam'=>'required',
            'tanggal_kembali'=>'required',
            'jumlah'=>'required',

        ]);

        $jumlah = $request->jumlah;



        Anggota::find($request->id_anggota)->update(['saldo' => DB::raw("saldo - $jumlah")]);;

        //fungsi eloquent untuk menambah data
        TransaksiPinjam::create($request->all());
        
        

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('transaksi_pinjam.index')
        ->with('success','Data transaksi berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi_pinjam=TransaksiPinjam::with('anggota')->where('id',$id)->first();
        $anggota=Anggota::all();
        return view('Pinjam.edit', compact('transaksi_pinjam','anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_pinjaman'=>'required',
            'id_anggota'=>'required',
            'tanggal_pinjam'=>'required',
            'tanggal_kembali'=>'required',
            'jumlah'=>'required',

        ]);
        TransaksiPinjam::where('id', $id)->update($data);


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('transaksi_pinjam.index')
            ->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiPinjam::where('id',$id)->delete();
        return redirect()->route('transaksi_pinjam.index')
            -> with('success', 'Data Berhasil Dihapus'); 
    }
}
