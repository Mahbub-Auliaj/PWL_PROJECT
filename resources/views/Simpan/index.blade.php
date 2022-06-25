@extends('layouts')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Daftar Transaksi Simpan</h2>
        </div>
        <div class="float-right my-2">
            <form action="{{ route('transaksi_simpan.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <div class="col-md">
                        <a class="btn btn-success" href="{{ route('transaksi_simpan.create') }}">Tambah</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID Transaksi</th>
        <th>Nama Anggota</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Bukti Transfer</th>
        <th width="280px">Action</th>
    </tr>
    @foreach($post as $simpan)
    <tr>
        <td>{{ $simpan->id }}</td>
        <td>{{ $simpan->anggota->nama }}</td>
        <td>{{ $simpan->tanggal }}</td>
        <td>{{ $simpan->jumlah }}</td>
        <td><img width="100px" src="{{asset('storage/'.$simpan->bukti_transfer)}}"></td>
        <td>
            <form action="{{ route('transaksi_simpan.destroy',['transaksi_simpan'=>$simpan->id]) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('transaksi_simpan.edit',$simpan->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center">
    {{ $post->links() }}
</div>

@endsection