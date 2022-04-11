<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Kelas extends Model
{
    use HasFactory;
    protected $table='kelas';

    // protected $fillable = [
    //     'Nim',
    //     'Kelas_id',
    //     'Nama_kelas',
    // ];

    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }
}
