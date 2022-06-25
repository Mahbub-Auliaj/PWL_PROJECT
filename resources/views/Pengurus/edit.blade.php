@extends('layouts')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
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
                <form method="POST" action="{{ route('mahasiswa.update', $Mahasiswa->nim) }}" id="myform">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $Mahasiswa->nim }}" aria-describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $Mahasiswa->nama }}" aria-describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" value="{{ $Mahasiswa->foto }}"></br>
                        <img width="150px" src="{{asset('storage/'.$Mahasiswa->foto)}}">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select name="kelas" class="form-control">
                            @foreach($kelas as $kls)
                            <option value="{{$kls->id}}" {{ $Mahasiswa->kelas_id == $kls->id ? 'selected' : '' }}> {{$kls->nama_kelas}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="text" name="Jurusan" class="form-control" id="Jurusan" value="{{ $Mahasiswa->jurusan }}" aria-describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="Email">E-mail</label>
                        <input type="text" name="Email" class="form-control" id="Email" value="{{ $Mahasiswa->email }}" aria-describedby="Email">
                    </div>
                    <div class="form-group">
                        <label for="No_handphone">No Handphone</label>
                        <input type="text" name="No_handphone" class="form-control" id="No_handphone" value="{{ $Mahasiswa->no_handphone }}" aria-describedby="No_handphone">
                    </div>
                    <div class="form-group">
                        <label for="ttl">TTL</label>
                        <input type="date" name="ttl" class="form-control" id="ttl" value="{{ $Mahasiswa->ttl }}" aria-describedby="ttl">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection