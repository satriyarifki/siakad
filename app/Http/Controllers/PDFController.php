<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mahasiswa;

class PDFController extends Controller
{
    public function cetak($id)
    {
        $Mahasiswa = Mahasiswa::where('nim', $id)->first();
        $Matakuliah = Mahasiswa::find($Mahasiswa->id)->matakuliah;
        $pdf = PDF::loadView('mahasiswa.nilai', ['Mahasiswa'=>$Mahasiswa, 'Matakuliah'=>$Matakuliah]);
        return $pdf->stream();
    }
}
