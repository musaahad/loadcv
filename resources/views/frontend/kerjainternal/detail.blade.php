@extends('frontend.templates.default')

@section('content')

<div class="col s12 m12">
    <div class="card horizontal hoverable">
        
        <img src="/assets/gambar_internal/{{$kerjainternal->gambar_depan}}" height="300px" width="300px">
        
       
        <div class="card-stacked">
            <div class="card-content">
            
                <h5 class="red-text accent-4"><b>Nama Debitur : {{$kerjainternal->internals->nama_debitur}}</b></h5>
                
                <table class="highlight">
                   <tbody>
                        <tr>
                            <td>PIC 1 :</td>
                            <td>{{$kerjainternal->internals->users->name}}</td>
                        </tr>
                        <tr>
                            <td>PIC 2 :</td>
                            <td>{{$kerjainternal->internals->users_id1}}</td>
                        </tr>
                        <tr>
                            <td>Bisnis Unit :</td>
                            <td>{{$kerjainternal->internals->bus->name}}</td>
                        </tr>
                        <tr>
                            <td>Tujuan Penilaian :</td>
                            <td>{{$kerjainternal->internals->tujuan}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Terima Order :</td>
                            <td>{{date('d M Y',strtotime($kerjainternal->internals->tanggal_terima))}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Objek :</td>
                            
                            <td >{{$kerjainternal->alamat}} Kelurahan {{$kerjainternal->villages}} 
                    Kecamatan {{$kerjainternal->districs}} {{$kerjainternal->city}} Provinsi {{$kerjainternal->province}} </td>
                        </tr>
                        <tr>
                            <td>Koordinat :</td>
                            <td>{{$kerjainternal->koordinat}} </td>
                        </tr>
                        <tr>
                            <td>Tanggal Penilaian :</td>
                            <td>{{date('d M Y',strtotime($kerjainternal->tanggal_penilaian))}}</td>
                        </tr>
                        <tr>
                            <td>Pemanfaatan Objek :</td>
                            <td>{{$kerjainternal->peruntukan}}</td>
                        </tr>
                        <tr>
                            <td>Pendekatan Penilaian :</td>
                            <td>{{$kerjainternal->pendekatan}}</td>
                        </tr>
                        <tr>
                            <td>Kawasan :</td>
                            <td>{{$kerjainternal->kawasan}}</td>
                        </tr>
                        <tr>
                            <td>Bentuk Tanah :</td>
                            <td>{{$kerjainternal->bentuk_tanah}}</td>
                        </tr>
                        <tr>
                            <td>Posisi Persil :</td>
                            <td>{{$kerjainternal->posisi}}</td>
                        </tr>
                        <tr>
                            <td>Frontage Persil :</td>
                            <td>{{$kerjainternal->frontage}} m</td>
                        </tr>
                        <tr>
                            <td>Elevasi :</td>
                            <td>{{$kerjainternal->elevasi}} m dari jalan</td>
                        </tr>
                        <tr>
                            <td>Lebar Jalan :</td>
                            <td>{{$kerjainternal->lebar_jalan}} m</td>
                        </tr>
                        <tr>
                            <td>Luas Tanah Total :</td>
                            <td>{{$kerjainternal->luas_tanah}} m2</td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan Total :</td>
                            <td>{{$kerjainternal->luas_bangunan}} m2</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Pasar :</b></td>
                            <td><b>Rp. {{number_format($kerjainternal->nilai_pasar)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>(Indikasi) Nilai Likuidasi :</b></td>
                            <td><b>Rp. {{number_format($kerjainternal->nilai_likuidasi)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Nilai Tanah/Ruko permeter :</b></td>
                            <td><b>Rp. {{number_format($kerjainternal->np_permeter)}}</b></td>
                        </tr>
                   </tbody> 
                </table>
            </div>
            <div class="card-action">
                <a href="{{route ('kerjainternal.datanilai')}}" class="btn blue accent-4 right waves-effect waves-light">Kembali</a>
            </div>
        </div>

    </div>

</div>


@endsection






