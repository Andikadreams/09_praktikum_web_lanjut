<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent


class Mahasiswa_Matakuliah extends Model //Definisi Model
{
    protected $table="mahasiswa_matakuliah"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel matakuliah_mahasiswa
    public $timestamp = false;
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id',
        'mahasiswa_id',
        'matakuliah_id',
        'nilai',
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }
};