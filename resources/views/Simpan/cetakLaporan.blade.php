<!DOCTYPE html>
<html>

<head>
    <title>Cetak Lapotan</title>
</head>

<body>
<div class="container mt-3">
    <h style="font-size:13;font-family: fantasy;"><center>Dinas kesejahteraan Masyarakat Kabupaten Pasuruan</center></h>
    <h style="font-size:25;font-family:'Times New Roman', Times, serif;"><center>KOPERASI MAJU JAYA</center></h>
    <h style="font-size:10;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif"><center>Jl. Pattimura no 45 Kec. Pandaan, Kab. Pasuruan, Jawa Timur kode pos: 67156 </center></h>
    <h style="font-size:9;font-family:Arial, Helvetica, sans-serif;"><center>email:majujaya@gmail.com telp:0821-2312-2232 </center></h>
    <hr />
    <hr />
    <h3><center>Laporan Transaksi Simpan</center></h3>
<table class="table table-bordered" style="
width:fit-content;
margin-left:auto;
margin-right:auto;
font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
border-collapse:collapse;" border="1">
    <tr>
        <th>ID</th>
        <th>Nama Anggota</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
    </tr>
    @foreach($transaksi_simpan as $simpan)
    <tr>
        <td><center>{{ $simpan->id }}</center></td>
        <td>{{ $simpan->anggota->nama }}</td>
        <td><center>{{ $simpan->tanggal }}</center></td>
        <td><center>{{ $simpan->jumlah }}</center></td>
        
    </tr>
    @endforeach
</table>

<h3><center>Laporan Transaksi Pinjam</center></h3>
<table class="table table-bordered" style="
width:fit-content;
margin-left:auto;
margin-right:auto;
font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
border-collapse:collapse;" border="1">
    <tr>
        <th>ID</th>
        <th>Nama Anggota</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah</th>
    </tr>
    @foreach($transaksi_pinjam as $pinjam)
    <tr>
        <td><center>{{ $pinjam->id }}</center></td>
        <td>{{ $pinjam->anggota->nama }}</td>
        <td><center>{{ $pinjam->tanggal_pinjam }}</center></td>
        <td><center>{{ $pinjam->tanggal_kembali }}</center></td>
        <td><center>{{ $pinjam->jumlah }}</center></td>
        
    </tr>
    @endforeach
</table>

    </div>
</body>

</html>