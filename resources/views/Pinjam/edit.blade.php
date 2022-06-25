@extends('layouts')

@section('content')

<div class="container" style="padding: 30px;">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 900px;">
            <div class="card-header">
                Edit Transaksi
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!!</strong> There were some problems with your input. <br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('transaksi_pinjam.update', $transaksi_pinjam->id) }}" id="myform">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_pinjaman">ID Transaksi</label>
                        <input type="text" name="id_pinjaman" class="form-control" id="id_pinjaman" value="{{ $transaksi_pinjam->id_pinjaman }}" aria-describedby="id_pinjaman" >
                    </div>
                    <div class="form-group">
                        <label for="Anggota">Anggota</label>
                        <select class="form-control" name="id_anggota">
                        @foreach($anggota as $agt)
                           <option value="{{$agt->id_anggota}}" {{$transaksi_pinjam->id_anggota == $agt->id_anggota ? 'selected' : '' }}>{{$agt->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" value="{{ $transaksi_pinjam->tanggal_pinjam }}" aria-describedby="tanggal_pinjam" >
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" value="{{ $transaksi_pinjam->tanggal_kembali }}" aria-describedby="tanggal_kembali" >
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" value="{{ $transaksi_pinjam->jumlah }}" aria-describedby="jumlah" >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection