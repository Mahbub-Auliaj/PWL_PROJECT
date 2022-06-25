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
                <form method="POST" action="{{ route('anggota.update', $anggota->id_anggota) }}" id="myform">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_anggota">ID Anggota</label>
                        <input type="text" name="id_anggota" class="form-control" id="id_anggota" value="{{ $anggota->id_anggota }}" aria-describedby="id_anggota">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $anggota->nama }}" aria-describedby="nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $anggota->alamat }}" aria-describedby="alamat">
                    </div>
                    <div class="form-group">
                        <label for="tahun_bergabung">Tahun Bergabung</label>
                        <input type="text" name="tahun_bergabung" class="form-control" id="tahun_bergabung" value="{{ $anggota->tahun_bergabung }}" aria-describedby="tahun_bergabung">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection