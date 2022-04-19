@extends('mahasiswa.layout')
@section('content')
    <div class="container d-flex justify-content-between mt-5">
    <div class="row  align-items-center">
    <div class="card" style="width: 24rem;">
    <div class="card-header">
    Kartu Studi Mahasiswa
    </div>
    <div class="card-body No" id="No" name="No">
    <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Nim: </b>{{$Mahasiswa->nim}}</li>
    <li class="list-group-item"><b>Nama: </b>{{$Mahasiswa->nama}}</li>
    <li class="list-group-item"><b>Kelas: </b>{{$Mahasiswa->kelas->nama_kelas}}</li>
    <li class="list-group-item"><b>Jurusan: </b>{{$Mahasiswa->jurusan}}</li>
    </ul>
    </div>
    </div>
    </div>
    <div style="margin:0px 0px 0px 70px;">
        <a class="btn btn-success" href="{{ route('cetak',$Mahasiswa->nim) }}"> Cetak PDF</a>
    </div>
    </div> 
    <br><br>
    <table class="table table-bordered">
        <tr>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        @foreach ($Matakuliah as $mk)
        <tr>
            <td>{{ $mk->nama_matkul }}</td>
            <td>{{ $mk->sks }}</td>
            <td>{{ $mk->semester }}</td>
            <td>{{ $mk->pivot->nilai }}</td>
            
        </tr>
        @endforeach
    </table>
    <a class="btn btn-success mt-3" href="{{ route('mahasiswa.index') }}">Kembali</a>
    
    <br><br>
@endsection