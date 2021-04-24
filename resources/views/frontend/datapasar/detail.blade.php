@extends('frontend.templates.default')

@section('content')

<div class="col s12 m12">
    <div class="card horizontal hoverable">
        
            <img src="/assets/data_gambar/{{$datapasar->gambar}}" height="300px" width="300px">
        
        
        
       
        <div class="card-stacked">
            <div class="card-content">
                <h5 class="red-text accent-4"><b>Alamat : {{$datapasar->alamat1}} Kel. {{$datapasar->villages1}} </b></h5>
                <table class="highlight">
                   <tbody>
                        <tr>
                            <td>Koordinat :</td>
                            <td>{{$datapasar->koordinat1}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Data :</td>
                            <td>{{date('d M Y',strtotime($datapasar->tanggal_data))}}</td>
                        </tr>
                        <tr>
                            <td>Pemanfaatan Objek :</td>
                            <td>{{$datapasar->peruntukan1}}</td>
                        </tr>
                        <tr>
                            <td>Penjual :</td>
                            <td>{{$datapasar->penjual}}</td>
                        </tr>
                        <tr>
                            <td>No. Telp Penjual :</td>
                            <td>{{$datapasar->notelp}}</td>
                        </tr>
                        <tr>
                            <td>Legalitas :</td>
                            <td>{{$datapasar->legalitas1}}</td>
                        </tr>
                        <tr>
                            <td>Bentuk Tanah :</td>
                            <td>{{$datapasar->bentuk_tanah1}}</td>
                        </tr>
                        <tr>
                            <td>Frontage :</td>
                            <td>{{$datapasar->frontage1}} m</td>
                        </tr>
                        <tr>
                            <td>Posisi Persil :</td>
                            <td>{{$datapasar->posisi1}}</td>
                        </tr>
                        <tr>
                            <td>Lebar Jalan :</td>
                            <td>{{$datapasar->lebar_jalan1}} m</td>
                        </tr>
                        <tr>
                            <td>Jarak dengan objek :</td>
                            <td>{{$datapasar->jarak_aktiva}} m</td>
                        </tr>
                        <tr>
                            <td>Luas Tanah Total :</td>
                            <td>{{$datapasar->luas_tanah1}} m2</td>
                        </tr>
                        <tr>
                            <td>Luas Bangunan Total :</td>
                            <td>{{$datapasar->luas_bangunan1}} m2</td>
                        </tr>
                        <tr>
                            <td><b>Harga Penawaran :</b></td>
                            <td><b>Rp. {{number_format($datapasar->harga_penawaran)}}</b></td>
                        </tr>
               
                   </tbody> 
                </table>
            </div>
            <div class="card-action">
                <a href="{{route ('datapasar.index')}}" class="btn blue accent-4 right waves-effect waves-light">Kembali</a>
            </div>
        </div>

    </div>

</div>


@endsection






