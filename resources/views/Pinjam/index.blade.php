@extends('layouts')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Daftar Transaksi Pinjam</h2>
        </div>
        <div class="float-right my-2">
            <form action="{{ route('transaksi_pinjam.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <div class="col-md">
                        <a class="btn btn-success" href="{{ route('transaksi_pinjam.create') }}">Tambah</a>
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
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah</th>
        <th width="280px">Action</th>
    </tr>
    @foreach($post as $pinjam)
    <tr>
        <td>{{ $pinjam->id_pinjaman }}</td>
        <td>{{ $pinjam->anggota->nama }}</td>
        <td>{{ $pinjam->tanggal_pinjam }}</td>
        <td>{{ $pinjam->tanggal_kembali }}</td>
        <td>{{ $pinjam->jumlah }}</td>
        <td>
            <form action="{{ route('transaksi_pinjam.destroy',['transaksi_pinjam'=>$pinjam->id]) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('transaksi_pinjam.edit',$pinjam->id) }}">Edit</a>
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