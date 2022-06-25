<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //search
        $search =  $pengurus = DB::table('pengurus');

        if(request('search')){
            $search->where('nama' , 'Like' , '%' . request('search') . '%')
                   ->orWhere('id_pengurus' , 'Like' , '%' . request('search') . '%');
        }
        //fungsi eloquent menampilkan data menggunakan pagination
        $pengurus = $search->paginate(3);//Mengambil semia isi tabel
        $posts = Pengurus::orderBy('id_pengurus','desc')->paginate(6);
        return view('Pengurus.index',compact('pengurus'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pengurus.create');
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
            'id_pengurus'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'jabatan'=>'required',
            'gaji'=>'required',

        ]);

        //fungsi eloquent untuk menambah data
        Pengurus::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('pengurus.index')
        ->with('success','Data Pengurus berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pengurus)
    {
        $pengurus = Pengurus::find($id_pengurus);
        return view('Pengurus.detail', compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pengurus)
    {
        $pengurus = DB::table('pengurus')->where('id_pengurus',$id_pengurus)->first();
        return view('Pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pengurus)
    {
        $request->validate([
            'id_pengurus'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'jabatan'=>'required',
            'gaji'=>'required',

        ]);

        //fungsi eloquent untuk mengupdate data inputan
        Pengurus::find($id_pengurus)->update($request->all());

        //jika data berhasil diupadate, akan kembali ke halaman utama
        return redirect()->route('pengurus.index')
        ->with('success', 'Data Pengurus Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pengurus)
    {
        $pengurus = DB::table('pengurus')->where('id_pengurus',$id_pengurus)->delete();
        return redirect()->route('pengurus.index')-> with('success', 'Data pengurus Berhasil Dihapus'); 
    }
}
