<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MataKuliah;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table='mahasiswa';
    protected $primaryKey='id';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'Nim',
        'Nama',
        'Email',
        'Kelas',
        'Jurusan',
        'Tanggal_lahir',
        'Alamat',
        'Featured_image',
    ];
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function matakuliah(){
        return $this->belongsToMany(MataKuliah::class)->withPivot('nilai');
    }

}
