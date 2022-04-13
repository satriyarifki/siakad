<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use DB;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        if ($cari != null) {
            $mahasiswa = Mahasiswa::where('nama','like',"%".$cari."%")->paginate(4);
        } else {
            $mahasiswa = Mahasiswa::all();
            $mahasiswa = Mahasiswa::paginate(4);
        }
         // Mengambil semua isi tabel
        $mahasiswa= Mahasiswa::with('kelas')->get();
        // $mahasiswa_matakuliah= Mahasiswa_Matakuliah::with('matakuliah')->get();
        // $mahasiswa_matakuliah= Mahasiswa_Matakuliah::with('mahasiswa')->get();
        $paginate = Mahasiswa::orderBy('id', 'asc')->paginate(4);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Email' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Tanggal_lahir' => 'required',
            'Alamat' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim=$request->get('Nim');
        $mahasiswa->nama=$request->get('Nama');
        $mahasiswa->email=$request->get('Email');
        $mahasiswa->jurusan=$request->get('Jurusan');
        $mahasiswa->tanggal_lahir=$request->get('Tanggal_lahir');
        $mahasiswa->alamat=$request->get('Alamat');
        $mahasiswa->save();
        //Mahasiswa::create($request->all());

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk menambah data yang relasi belongsto
        
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty('kod') ) {
            // $Mahasiswa = Mahasiswa::with('Matakuliah')->where('nim', $id)->first();
            $Mahasiswa = Mahasiswa::where('nim', $id)->first();
            $Matakuliah = Mahasiswa::find($Mahasiswa->id)->matakuliah;
            
            // echo ($Pivot->matakuliah_id);
            // echo ($Matakuliah->nama_matkul);
            // echo $Matakul;
            return view('mahasiswa.nilai', compact('Mahasiswa','Matakuliah'));
        } else {
            $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $id)->first();
            return view('mahasiswa.detail', compact('Mahasiswa'));
        }
        
        

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $id)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Email' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Tanggal_lahir' => 'required',
            'Alamat' => 'required',
        ]);
        // Mahasiswa::where('nim', $id)
        //     ->update([
        //     'nim'=>$request->Nim,
        //     'nama'=>$request->Nama,
        //     'email'=>$request->Email,
        //     'kelas'=>$request->Kelas,
        //     'jurusan'=>$request->Jurusan,
        //     'tanggal_lahir'=>$request->Tanggal_lahir,
        //     'alamat'=>$request->Alamat,
        // ]);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $id)->first();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get ('Nama');
        $mahasiswa->email = $request->get ('Email');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_lahir');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        // Mahasiswa::find($id)->update($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($id)
    {
        $Mahasiswa = Mahasiswa_Matakuliah::with('Mahasiswa', 'Matakuliah')->where('nim', $id)->first();
        return view('mahasiswa.nilai', compact('Mahasiswa', 'Matakuliah'));
    }
    
}
