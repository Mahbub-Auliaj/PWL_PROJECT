@extends('layouts')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Daftar Pengurus</h2>
        </div>
        <div class="float-right my-2">
            <form action="{{ route('pengurus.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <div class="col-md">
                        <a class="btn btn-success" href="{{ route('pengurus.create') }}"> Input Pengurus</a>
                    </div>
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
@if ($pengurus->count())
<table class="table table-bordered">
    <tr>
        <th>ID Pengurus</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jabatan</th>
        <th>Gaji</th>
        <th width="280px">Action</th>
    </tr>
    @foreach($pengurus as $png)
    <tr>
        <td>{{ $png->id_pengurus }}</td>
        <td>{{ $png->nama }}</td>
        <td>{{ $png->alamat }}</td>
        <td>{{ $png->jabatan }}</td>
        <td>{{ $png->gaji }}</td>
        <td>
            <form action="{{ route('pengurus.destroy',['penguru'=>$png->id_pengurus]) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('pengurus.edit',$png->id_pengurus) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>



@else
<p class="text-center fs-4">Pengurus tidak ditemukan.</p>
@endif

<div class="d-flex justify-content-center">
    {{ $pengurus->links() }}
</div>

@endsection