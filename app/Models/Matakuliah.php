<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Matakuliah extends Model //Definisi Model
{
    protected $table="matakuliah"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    protected $timestamp = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id',
        'nama_matkul',
        'sks',
        'jam',
        'semester',
    ];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class,'matakuliah_mahasiswa', 'mahasiswa_id','matakuliah_id');
    }
    public function matakuliah_mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa_Matakuliah::class);
    }
};