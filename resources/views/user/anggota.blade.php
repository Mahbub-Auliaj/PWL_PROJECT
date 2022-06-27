@extends('user.layouts')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Daftar Anggota</h2>
        </div>
        <div class="float-right my-2">
            <form action="{{ route('anggota.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($message=Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if ($anggota->count())
<table class="table table-bordered">
    <tr>
        <th>ID Anggota</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tahun Bergabung</th>
        <th>Saldo</th>
    </tr>
    @foreach($anggota as $agt)
    <tr>
        <td>{{ $agt->id_anggota }}</td>
        <td>{{ $agt->nama }}</td>
        <td>{{ $agt->alamat }}</td>
        <td>{{ $agt->tahun_bergabung }}</td>
        <td>{{ $agt->saldo }}</td>
    </tr>
    @endforeach
</table>



@else
<p class="text-center fs-4">Anggota tidak ditemukan.</p>
@endif

<div class="d-flex justify-content-center">
    {{ $anggota->links() }}
</div>


@endsection