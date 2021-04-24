@extends('frontend.templates.default')

@section('content')

<div class="col s12 m12">
    <div class="card horizontal hoverable">
   
        <img src="/assets/gambar_review/{{$kerjareview->gambar_review}}"height="300px" width="300px">
        
       
        <div class="card-stacked">
            <div class="card-content">
                <h5 class="red-text accent-4"><b>Nama Debitur : {{$kerjareview->reviews->nama_debitur}}</b></h5>
                <table class="highlight">
                    <tbody>
                        <tr>
                            <td>PIC :</td>
                            <td>{{$kerjareview->reviews->users->name}}</td>
                        </tr>
                        <tr>
                            <td>Bisnis Unit :</td>
                            <td>{{$kerjareview->reviews->bus->name}}</td>
                        </tr>
                        <tr>
                            <td>Tujuan Penilaian :</td>
                            <td>{{$kerjareview->reviews->tujuan}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Terima Order :</td>
                            <td>{{date('d M Y',strtotime($kerjareview->reviews->tanggal_terima))}}</td>
                        </tr>
                        <tr>
                            <td>KJPP :</td>
                            <td>{{$kerjareview->reviews->kjpps->name}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Objek :</td>
                            <td>{{$kerjareview->alamat}} Kelurahan {{$kerjareview->villages}} 
                    Kecamatan {{$kerjareview->districs}} {{$kerjareview->city}} Provinsi {{$kerjareview->province}} </td>
                        </tr>
                        <tr>
                            <td>Koordinat :</td>
                            <td>{{$kerjareview->koordinat}} </td>
                        </tr>
                        <tr>
                            <td>Tanggal Penilaian :</td>
                            <td>{{date('d M Y',strtotime($kerjareview->tanggal_penilaian))}}</td>
                        </tr>
                        <tr>
                            <td>Pemanfaatan Objek :</td>
                            <td>{{$kerjareview->peruntukan}}</td>
                        </tr>
                        <tr>
                            <td>Pendekatan Penilaian :</td>
                            <td>{{$kerjareview->pendekatan}}</td>
                        </tr>
                        <tr>
                            <td>Bentuk Tanah :</td>
                            <td>{{$kerjareview->bentuk_tanah}}</td>
                        </tr>
                        <tr>
                            <td>Posisi Persil:</td>
                            <td>{{$kerjareview->posisi}}</td>
                        </tr>
                        <tr>
                            <td>Frontage Persil:</td>
                            <td>{{$kerjareview->frontage}} m</td>
                        </tr>
                        <tr>
                            <td>Lebar Jalan :</td>
                            <td>{{$kerjareview->lebar_jalan}} m</td>
                        </tr>
                        <tr>
                            <td>Luas Tanah Total :</td>
                            <td>{{$kerjareview->lt_total}} m2</td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan Total :</td>
                            <td>{{$kerjareview->lb_total}} m2</td>
                        </tr>
                        <tr>
                            <td><b>Nilai Pasar :</b></td>
                            <td><b>Rp. {{number_format($kerjareview->npt)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>(Indikasi) Nilai Likuidasi :</b></td>
                            <td><b>Rp. {{number_format($kerjareview->nlt)}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Nilai Tanah/Ruko permeter :</b></td>
                            <td><b>Rp. {{number_format($kerjareview->np_permeter)}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-action">
                <a href="{{route ('kerjareview.datanilai')}}" class="btn blue accent-4 right waves-effect waves-light">Kembali</a>
            </div>
        </div>

    </div>

</div>


@endsection






