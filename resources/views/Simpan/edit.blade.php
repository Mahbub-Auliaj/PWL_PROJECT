@extends('layouts')

@section('content')

<div class="container" style="padding: 30px;">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 900px;">
            <div class="card-header">
                Edit Anggota
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
                <form method="POST" action="{{ route('transaksi_simpan.update', $transaksi_simpan->id) }}" id="myform" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_simpanan">ID Transaksi</label>
                        <input type="text" name="id_simpanan" class="form-control" id="id_simpanan" value="{{ $transaksi_simpan->id_simpanan }}" aria-describedby="id_simpanan">
                    </div>
                    <div class="form-group">
                        <label for="Anggota">Anggota</label>
                        <select class="form-control" name="id_anggota">
                        @foreach($anggota as $agt)
                           <option value="{{$agt->id_anggota}}" {{$transaksi_simpan->id_anggota == $agt->id_anggota ? 'selected' : '' }}>{{$agt->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $transaksi_simpan->tanggal }}" aria-describedby="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" value="{{ $transaksi_simpan->jumlah }}" aria-describedby="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="image">Bukti Transfer</label>
                        <input type="file" name="image" class="form-control" id="image" value="{{ $transaksi_simpan->bukti_transfer }}" aria-describedby="image">
                        <img width="100px" src="{{asset('storage/'.$transaksi_simpan->bukti_transfer)}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection