@extends('mahasiswas.layout')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your i
                    nput.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->Nim) }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->Nim }}"
                            aria-describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->Nama }}"
                            aria-describedby="Nama">
                    </div>
                    <!-- Edit Tugas praktikum 10 -->
                    <div class="form-group">
                            <label for="image">Foto</label>
                            <input type="file" class="form-control" required="required" name="image" value="{{$mahasiswa->Foto}}"></br>
                            <img width="150px" src="{{asset('storage/'.$mahasiswa->Foto)}}">
                    </div>
                    <!-- ----------------------- -->
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select name="Kelas" class="form-control">
                            @foreach ($kelas as $Kelas)
                            <option value="{{$Kelas->id}}"{{($mahasiswa->kelas_id==$Kelas->id)?'selected':''}}>{{$Kelas->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan"
                            value="{{ $mahasiswa->Jurusan }}" aria-describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="No_Handphone">No_Handphone</label>
                        <input type="No_Handphone" name="No_Handphone" class="form-control" id="No_Handphone"
                            value="{{ $mahasiswa->No_Handphone }}" aria-describedby="No_Handphone">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="Email" name="Email" class="form-control" id="Email"
                            value="{{ $mahasiswa->Email }}" aria-describedby="Email">
                    </div>
                    <div class="form-group">
                        <label for="TTL">TTL</label>
                        <input type="TTL" name="TTL" class="form-control" id="TTL"
                            value="{{ $mahasiswa->TTL }}" aria-describedby="TTL">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-danger" role="button" aria-disabled="true" style="margin-left:5px">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
