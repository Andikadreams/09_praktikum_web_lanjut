<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Mahasiswa_Matakuliah;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::paginate(5); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        return view('mahasiswas.index', compact('mahasiswas'));
        // with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $kelas = Kelas::all(); //Mendapatkan data dari tabel kelas
        return view('mahasiswas.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Edit untuk Tugas Praktikum 10
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('image', 'public');
        }
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'Email' => 'required',
        'TTL' => 'required',
        ]);
        //fungsi eloquent untuk menambah data Prak 7
        // Mahasiswa::create($request->all());

        //fungsi eloquent untuk menambah data Prak 9
        $mahasiswa =  new Mahasiswa;
        $mahasiswa -> Nim =$request->get('Nim');
        $mahasiswa -> Nama =$request->get('Nama');
        // Edit untuk Tugas Praktikum 10
        // start Praktikum 10 TUGAS
        $mahasiswa -> Foto =$image_name;
        // end
        $mahasiswa -> Jurusan =$request->get('Jurusan');
        $mahasiswa -> No_Handphone =$request->get('No_Handphone');
        $mahasiswa -> Email =$request->get('Email');
        $mahasiswa -> TTL =$request->get('TTL');

        //fungsi eloquent untuk menambah data dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'Email' => 'required',
        'TTL' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita Prak 7
        // Mahasiswa::find($Nim)->update($request->all());

        //fungsi eloquent untuk mengupdate data inputan kita Prak 9

        // Edit untuk Tugas Praktikum 10
        $mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
            if ($mahasiswa->Foto && file_exists(storage_path('app/public/' .$mahasiswa->Foto))) {
                Storage::delete('public/' .$mahasiswa->Foto);
            }
        // -------------------------
        // Edit untuk Tugas Praktikum 10
        $image_name = $request->file('image')->store('images', 'public');
        // -------------------------
        // $mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa -> Nim =$request->get('Nim');
        $mahasiswa -> Nama =$request->get('Nama');
        // Edit untuk Tugas Praktikum 10
        $mahasiswa->Foto=$image_name;
        // -------------------------
        $mahasiswa -> Jurusan =$request->get('Jurusan');
        $mahasiswa -> No_Handphone =$request->get('No_Handphone');
        $mahasiswa -> Email =$request->get('Email');
        $mahasiswa -> TTL =$request->get('TTL');        

        //fungsi eloquent untuk menambah data dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%" . $keyword . "%")->paginate(1);
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function nilai($Nim)
    {
        //$Mahasiswa = Mahasiswa::find($nim);
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        //$MataKuliah = $Mahasiswa->MataKuliah()->get();
        $Mahasiswa_Matakuliah = Mahasiswa_Matakuliah::where('mahasiswa_id','=',$Nim)->get();
        return view('mahasiswas.nilai',['Mahasiswa' => $Mahasiswa],['Mahasiswa_Matakuliah' => $Mahasiswa_Matakuliah],['Matakuliah' => $Matakuliah], compact('Mahasiswa_Matakuliah'));
    }

    public function cetak_pdf($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $MahasiswaMataKuliah = Mahasiswa_MataKuliah::where('mahasiswa_id','=',$Nim)->get();
        $pdf = PDF::loadview('mahasiswas.nilai_pdf', compact('Mahasiswa','MahasiswaMataKuliah'));
        return $pdf->download($Mahasiswa->Nama .'-'. $Mahasiswa->Nim .'.pdf');
    }

};
