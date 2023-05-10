@extends('mahasiswas.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div style="text-align: center">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            <h3 style="margin-top: 20px; ">Kartu Hasil Studi (KHS)</h3><br>
        </div>
</div>
            <table>
            <tr>
            <td>
            <h6><b>Nama&emsp;: </b>{{$Mahasiswa->Nama}}</h6>
            <h6><b>Nim&ensp;&ensp;&ensp;&nbsp;: </b>{{$Mahasiswa->Nim}}</h6>
            <h6><b>Kelas&ensp;&ensp;&nbsp;: </b>{{$Mahasiswa->Kelas->nama_kelas}}</h6>
            <h6><b>Jurusan&nbsp;: </b>{{$Mahasiswa->Jurusan}}</h6>
            </td>
            <td><img width="99px" src="{{asset('storage/'.$Mahasiswa->Foto)}}" style="margin-left: 250px; margin-bottom:5px"></td>
            </tr>
            </table>
            
        <div class="row justify-content-center align-items-center">  
        <div class="card" style="width: 100rem;">
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
                    </table><br>

                    <br>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <a class="btn btn-primary btn-lg" style="margin-left:430px; margin-top:5px;" href="{{ route('cetak_pdf',$Mahasiswa->Nim) }}">Cetak ke PDF</a>
    <a class="btn btn-danger btn-lg" style="margin-left:20px; margin-top:5px;" href="{{ route('mahasiswa.index') }}">Kembali</a>
    @endsection