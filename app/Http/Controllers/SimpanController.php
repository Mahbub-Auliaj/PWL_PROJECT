<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\TransaksiPinjam;
use App\Models\TransaksiSimpan;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SimpanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //yang semulanya Mahasiswa::all menjadi mahasiswa with yang menyatakan relasi
        $transaksi_simpan = TransaksiSimpan::with('anggota')->get();
    
        // fungsi latest berfungsi untuk menampilkan berdasarkan data terakhir di input    
        $post = TransaksiSimpan::latest();
        // search berdasarkan nama atau nim
        if (request('search')) {
            $post->where('id_simpanan', 'like', '%' . request('search') . '%')->orWhere('jumlah','like','%' . request('search').'%');
        }

        //add pagination 
        return view('Simpan.index',[
            'transaksi_simpan' => $transaksi_simpan,
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
        return view('Simpan.create',['anggota'=>$anggota]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')){
            $foto_bukti = $request->file('image')->store('images','public');
        }

        $jumlah = $request->jumlah;
        Anggota::find($request->id_anggota)->update(['saldo' => DB::raw("saldo + $jumlah")]);

        //fungsi eloquent untuk menambah data
        TransaksiSimpan::create([
            'id_simpanan'=>$request->id_simpanan,
            'id_anggota'=>$request->id_anggota,
            'tanggal'=>$request->tanggal,
            'jumlah'=>$request->jumlah,
            'bukti_transfer'=>$foto_bukti,
        ]);
        
        

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('transaksi_simpan.index')
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
        $transaksi_simpan = TransaksiSimpan::with('anggota')->where('id',$id)->first();
        $anggota = Anggota::all();
        return view('Simpan.edit', compact('transaksi_simpan','anggota'));
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
        $transaksi_simpan = TransaksiSimpan::where('id',$id)->first();

        $transaksi_simpan->id_simpanan = $request->get('id_simpanan');
        $transaksi_simpan->id_anggota = $request->get('id_anggota');
        $transaksi_simpan->tanggal = $request->get('tanggal');
        $transaksi_simpan->jumlah = $request->get('jumlah');

        if($transaksi_simpan->bukti_transfer && file_exists(storage_path('app/public/' . $transaksi_simpan->bukti_transfer))){
            Storage::delete('public/' . $transaksi_simpan->bukti_transfer);
        }
        

        //$image_name = $request->file('image')->store('images','public');
        if ($request->file('image') == null) {
            $transaksi_simpan->bukti_transfer = "";
        }else{
            $transaksi_simpan->bukti_transfer = $request->file('image')->store('images','public');  
        }


        $jumlah = $request->get('jumlah');
        $transaksi_simpan->save();
        Anggota::find($request->id_anggota)->update(['saldo' => DB::raw("saldo + $jumlah")]);
        
        
        //$transaksi_simpan->bukti_transfer = $foto_bukti;

        
        
        //jika data berhasil diupadate, akan kembali ke halaman utama
        return redirect()->route('transaksi_simpan.index')
        ->with('success', 'Data Transaksi Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi_simpan = DB::table('transaksi_simpan')->where('id',$id)->delete();
        return redirect()->route('transaksi_simpan.index')-> with('success', 'Data transaksi Berhasil Dihapus'); 
    }

    public function cetak_pdf(){
        $transaksi_simpan = TransaksiSimpan::with('anggota')->get();
        $transaksi_pinjam = TransaksiPinjam::with('anggota')->get();
        $pdf = PDF::loadview('Simpan.cetakLaporan',['transaksi_simpan'=>$transaksi_simpan,'transaksi_pinjam'=>$transaksi_pinjam]);
        return $pdf->stream();
    }
    
}
