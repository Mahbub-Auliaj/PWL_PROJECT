@extends('layouts')

@section('content')
<div class="container" style="padding: 30px;">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 900px;">
            <div class="card-header">
                Tambah Pengurus
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
            <form method="POST" action="{{ route('pengurus.store') }}" id="myform">
            @csrf
                <div class="form-group">
                    <label for="id_pengurus">ID Pengurus</label>
                    <input type="text" name="id_pengurus" class="form-control" id="id_pengurus" aria-describedby="id_pengurus" >
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" >
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat" >
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" id="jabatan" aria-describedby="jabatan" >
                </div>
                <div class="form-group">
                    <label for="gaji">Gaji</label>
                    <input type="text" name="gaji" class="form-control" id="gaji" aria-describedby="gaji" >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection