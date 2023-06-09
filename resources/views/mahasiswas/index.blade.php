@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div>
            <form class="form-left my-2" method="get" action="{{ route('search') }}">
            <div class="form-group w-80 mb-3">
                        <input type="text" name="search" class="form-control w-50 d-inline" id="search" placeholder="Masukkan Nama">
                        <button type="submit" class="btn btn-primary mb-1">Cari</button>
                        <a class="btn btn-success right" href="{{ route('mahasiswa.index') }}" style="margin-left:160px"> Show All Mahasiswa</a>
                        <a class="btn btn-success right" href="{{ route('mahasiswa.create') }}" style="margin-left:10px"> Input Mahasiswa</a>
                    </div>
            </form>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <!-- Edit Tugas praktikum 10 -->
        <th>Foto</th>
        <!-- ----------------------- -->
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No_Handphone</th>
        <th>Email</th>
        <th>TTL</th>
        <th width="350px">Action</th>
    </tr>
    @foreach ($mahasiswas as $Mahasiswa)
    <tr>

        <td>{{ $Mahasiswa->Nim }}</td>
        <td>{{ $Mahasiswa->Nama }}</td>
        <!-- Edit Tugas praktikum 10 -->
        <td><img width="100px" src="{{asset('storage/'.$Mahasiswa->Foto)}}"></td>
        <!-- ----------------------- -->
        <td>{{ $Mahasiswa->Kelas->nama_kelas }}</td>
        <td>{{ $Mahasiswa->Jurusan }}</td>
        <td>{{ $Mahasiswa->No_Handphone }}</td>
        <td>{{ $Mahasiswa->Email }}</td>
        <td>{{ $Mahasiswa->TTL }}</td>
        <td>
            <form action="{{ route('mahasiswa.destroy',$Mahasiswa->Nim) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswa.show',$Mahasiswa->Nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$Mahasiswa->Nim) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="{{ route('nilai',$Mahasiswa->Nim) }}">Nilai</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="my-2" width="500px">
{{$mahasiswas->links()}}
</div>
@endsection
