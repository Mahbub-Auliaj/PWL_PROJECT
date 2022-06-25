<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //search
        $search =  $anggota = DB::table('anggota');

        if(request('search')){
            $search->where('nama' , 'Like' , '%' . request('search') . '%')
                   ->orWhere('id_anggota' , 'Like' , '%' . request('search') . '%');
        }
        //fungsi eloquent menampilkan data menggunakan pagination
        $anggota = $search->paginate(3);//Mengambil semia isi tabel
        $posts = Anggota::orderBy('id_anggota','desc')->paginate(6);
        return view('Anggota.index',compact('anggota'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Anggota.create');
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
            'id_anggota'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'tahun_bergabung'=>'required',
        ]);

        //fungsi eloquent untuk menambah data
        Anggota::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('anggota.index')
        ->with('success','Data Dosen berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_anggota)
    {
        $anggota = Anggota::find($id_anggota);
        return view('Anggota.detail', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_anggota)
    {
        $anggota = DB::table('anggota')->where('id_anggota',$id_anggota)->first();
        return view('Anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_anggota)
    {
        $request->validate([
            'id_anggota'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'tahun_bergabung'=>'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan
        Anggota::find($id_anggota)->update($request->all());

        //jika data berhasil diupadate, akan kembali ke halaman utama
        return redirect()->route('anggota.index')
        ->with('success', 'Data Anggota Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_anggota)
    {
        DB::table('transaksi_pinjam')->where('id_anggota',$id_anggota)->delete();
        DB::table('transaksi_simpan')->where('id_anggota',$id_anggota)->delete();
        $anggota = DB::table('anggota')->where('id_anggota',$id_anggota)->delete();
        return redirect()->route('anggota.index')
        -> with('success', 'Data Anggota Berhasil Dihapus'); 
    }
}
