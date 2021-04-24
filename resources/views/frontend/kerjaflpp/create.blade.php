@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center;"><b>Lengkapi Data Inspeksi FLPP an {{$kerjaflpp->flpps->nama_debitur}}</b></h5><br><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('kerjaflpp.update', $kerjaflpp)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        <div class="row">
          
           
            <div class="input-field col s12">
                <input type="text" name="tanggal_inspeksi" class="datepicker" 
                value="{{$kerjaflpp->tanggal_inspeksi ?? old('tanggal_inspeksi')}}">
                <label for="icon_prefix">Tanggal Inspeksi</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="blok" class="form-control" 
                placeholder="Blok objek" value="{{$kerjaflpp->blok ?? old('blok')}}">
                <label for="">Blok Objek</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="koordinat" class="form-control" 
                placeholder="Koordinat" value="{{$kerjaflpp->koordinat ?? old('koordinat')}}">
                <label for="">Koordinat</label>
            </div>
          
            <div class="input-field col s12">
                <select name="legalitas" id="legalitas" class="validate">
                    <option value="{{$kerjaflpp->legalitas?? old('legalitas')}}" selected>{{$kerjaflpp->legalitas}}</option>
                    <option value="SHM">SHM</option>
                    <option value="SHGB">SHGB</option>
                </select>
                <label for="">Jenis Legalitas</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="no_sertifikat" class="validate" 
                placeholder="Nomor sertifikat" value="{{$kerjaflpp->no_sertifikat ?? old('no_sertifikat')}}">
                <label for="">Nomor Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tanggal_terbit" class="datepicker" 
                value="{{$kerjaflpp->tanggal_terbit ?? old('tanggal_terbit')}}">
                <label for="icon_prefix">Tanggal Terbit Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tanggal_berakhir" class="datepicker" 
                value="{{$kerjaflpp->tanggal_berakhir ?? old('tanggal_berakhir')}}">
                <label for="icon_prefix">Tanggal Berakhir Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="no_gs" class="validate" 
                placeholder="Nomor GS" value="{{$kerjaflpp->no_gs ?? old('no_gs')}}">
                <label for="">Nomor GS/SU</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tgl_gs" class="datepicker" 
                value="{{$kerjaflpp->tgl_gs ?? old('tgl_gs')}}">
                <label for="icon_prefix">Tanggal GS/SU</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="atas_nama" class="validate" 
                placeholder="Atas Nama" value="{{$kerjaflpp->atas_nama ?? old('atas_nama')}}">
                <label for="">Nama di Sertifikat</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="no_imb" class="validate" 
                value="{{$kerjaflpp->no_imb ?? old('no_imb')}}">
                <label for="icon_prefix">No. IMB</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tanggal_imb" class="datepicker" 
                value="{{$kerjaflpp->tanggal_imb ?? old('tanggal_imb')}}">
                <label for="icon_prefix">Tanggal IMB</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_tanah" class="validate" 
                value="{{$kerjaflpp->luas_tanah ?? old('luas_tanah')}}">
                <label for="icon_prefix">Luas Tanah</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_bangunan" class="validate" 
                value="{{$kerjaflpp->luas_bangunan ?? old('luas_bangunan')}}">
                <label for="icon_prefix">Luas Bangunan</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="tahun_bangun" class="datepicker" 
                value="{{$kerjaflpp->tahun_bangun ?? old('tahun_bangun')}}">
                <label for="icon_prefix">Tahun Bangun</label>
            </div>
   
            <div class="input-field col s12">    
                <select name="kondisi_jalan"  class="validate">
                    <option value="{{$kerjaflpp->kondisi_jalan?? old('kondisi_jalan')}}" selected>{{$kerjaflpp->kondisi_jalan}}</option>  
                    <option value="Aspal">Aspal</option>
                    <option value="Paving Blok">Paving Blok</option>
                    <option value="Beton">Beton</option>
                    <option value="Masih perkerasan tanah">Masih perkerasan tanah</option>
                    <option value="Belum ada jalan">Belum ada jalan</option>
                </select>
                <label for="">Kondisi Jalan</label>
            </div>


            <div class="input-field col s12">    
                <select name="kondisi_drainase"  class="validate">
                    <option value="{{$kerjaflpp->kondisi_drainase?? old('kondisi_drainase')}}" selected>{{$kerjaflpp->kondisi_drainase}}</option>  
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                    <option value="Buruk">Buruk</option>
                </select>
                <label for="">Kondisi Drainase</label>
            </div>

            <div class="input-field col s12">    
                <select name="listrik"  class="validate">
                    <option value="{{$kerjaflpp->listrik?? old('listrik')}}" selected>{{$kerjaflpp->listrik}}</option>  
                    <option value="Ada">Ada</option>
                    <option value="Belum Ada">Belum Ada</option>
                </select>
                <label for="">Listrik</label>
            </div>

            <div class="input-field col s12">    
                <select name="air"  class="validate">
                    <option value="{{$kerjaflpp->air?? old('air')}}" selected>{{$kerjaflpp->air}}</option>  
                    <option value="PDAM">PDAM</option>
                    <option value="Sumur Bor">Sumur Bor</option>
                    <option value="Belum Ada">Belum Ada</option>
                </select>
                <label for="">Air</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="lebar_jalan" class="validate" 
                value="{{$kerjaflpp->lebar_jalan ?? old('lebar_jalan')}}">
                <label for="icon_prefix">Lebar Jalan</label>
            </div>

            <div class="input-field col s12">    
                <select name="sekolah"  class="validate">
                    <option value="{{$kerjaflpp->sekolah?? old('sekolah')}}" selected>{{$kerjaflpp->sekolah}}</option>  
                    <option value="Kurang dari 0.5 km">Kurang dari 0.5 km</option>
                    <option value="Antara 0.5 sd 1 km">Antara 0.5 sd 1 km</option>
                    <option value="Antara 1 sd 2 km">Antara 1 sd 2 km</option>
                    <option value="Lebih dari 2 km">Lebih dari 2 km</option>
                </select>
                <label for="">Jarak dengan Fasilitas Pendidikan</label>
            </div>

            <div class="input-field col s12">    
                <select name="pasar"  class="validate">
                    <option value="{{$kerjaflpp->pasar?? old('pasar')}}" selected>{{$kerjaflpp->pasar}}</option>  
                    <option value="Kurang dari 0.5 km">Kurang dari 0.5 km</option>
                    <option value="Antara 0.5 sd 1 km">Antara 0.5 sd 1 km</option>
                    <option value="Antara 1 sd 2 km">Antara 1 sd 2 km</option>
                    <option value="Lebih dari 2 km">Lebih dari 2 km</option>
                </select>
                <label for="">Jarak dengan Pasar/Pusat Perbelanjaan</label>
            </div>

            <div class="input-field col s12">    
                <select name="spbu"  class="validate">
                    <option value="{{$kerjaflpp->spbu?? old('spbu')}}" selected>{{$kerjaflpp->spbu}}</option>  
                    <option value="Kurang dari 0.5 km">Kurang dari 0.5 km</option>
                    <option value="Antara 0.5 sd 1 km">Antara 0.5 sd 1 km</option>
                    <option value="Antara 1 sd 2 km">Antara 1 sd 2 km</option>
                    <option value="Lebih dari 2 km">Lebih dari 2 km</option>
                </select>
                <label for="">Jarak dengan SPBU</label>
            </div>

            <div class="input-field col s12">    
                <select name="ibadah"  class="validate">
                    <option value="{{$kerjaflpp->ibadah?? old('ibadah')}}" selected>{{$kerjaflpp->ibadah}}</option>  
                    <option value="Kurang dari 0.5 km">Kurang dari 0.5 km</option>
                    <option value="Antara 0.5 sd 1 km">Antara 0.5 sd 1 km</option>
                    <option value="Antara 1 sd 2 km">Antara 1 sd 2 km</option>
                    <option value="Lebih dari 2 km">Lebih dari 2 km</option>
                </select>
                <label for="">Jarak dengan Fasilitas Peribadatan</label>
            </div>

            <div class="input-field col s12">    
                <select name="kuburan"  class="validate">
                    <option value="{{$kerjaflpp->kuburan?? old('kuburan')}}" selected>{{$kerjaflpp->kuburan}}</option>  
                    <option value="Kurang dari 0.5 km">Kurang dari 0.5 km</option>
                    <option value="Antara 0.5 sd 1 km">Antara 0.5 sd 1 km</option>
                    <option value="Antara 1 sd 2 km">Antara 1 sd 2 km</option>
                    <option value="Lebih dari 2 km">Lebih dari 2 km</option>
                </select>
                <label for="">Jarak dengan Fasilitas Pemakaman</label>
            </div>
            

            <div class="input-field col s12" >
                <textarea name="keterangan"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$kerjaflpp->keterangan ?? old('keterangan')}}</textarea>
                <label for="">Catatan Untuk Objek Ini</label>
            </div>

            <div class="input-field col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="gambar_flpp">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Foto Tampak Depan">
                </div>
            </div>
            </div>

            </div>

            
           
            <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit" name="action">Simpan
                <i class="material-icons right">save</i>
            </button>
            </div>
    </form>
    </div>
  
@endsection

@push('scripts')
    
<script>
   

</script>

@endpush



