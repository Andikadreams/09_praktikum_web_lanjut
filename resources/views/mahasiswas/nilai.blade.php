@extends('mahasiswas.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div style="text-align: center">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            <h3 style="margin-top: 20px; ">Kartu Rencana Studi (KRS)</h3>
        </div>
        <div class="card" style="width: 100rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nama: </b>{{$Mahasiswa->Nama}}</li>
                <li class="list-group-item"><b>Nim: </b>{{$Mahasiswa->Nim}}</li>
                <li class="list-group-item"><b>Kelas: </b>{{$Mahasiswa->Kelas->nama_kelas}}</li>
                <li class="list-group-item"><b>Jurusan: </b>{{$Mahasiswa->Jurusan}}</li>
            </ul>
            <div class="col-lg-12 margin-tb">
                <table class="table table-bordered">
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                    </tr>
                    @foreach ($Mahasiswa_Matakuliah as $M)
                    <tr>
                        <td>{{$M->matakuliah->nama_matkul}}</td>
                        <td>{{$M->matakuliah->sks}}</td>
                        <td>{{$M->matakuliah->semester}}</td>
                        <td>{{$M->nilai}}</td>
                    @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endsection