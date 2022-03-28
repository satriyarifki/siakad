<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use DB;

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
        $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(4);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
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

        Mahasiswa::create($request->all());
        
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
        $Mahasiswa = Mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Mahasiswa = DB::table('mahasiswa')->where('nim', $id)->first();
        return view('mahasiswa.edit', compact('Mahasiswa'));
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
        Mahasiswa::where('nim', $id)
            ->update([
            'nim'=>$request->Nim,
            'nama'=>$request->Nama,
            'email'=>$request->Email,
            'kelas'=>$request->Kelas,
            'jurusan'=>$request->Jurusan,
            'tanggal_lahir'=>$request->Tanggal_lahir,
            'alamat'=>$request->Alamat,
        ]);

        Mahasiswa::find($id)->update($request->all());

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

    public function search(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$mahasiswa = Mahasiswa::where('nama','like',"%".$cari."%")->paginate(4);
 
    		// mengirim data pegawai ke view index
		return view('mahasiswa.index',['mahasiswa' => $mahasiswa]);
 
	}
}
