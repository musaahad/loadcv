@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center;"><b>Lengkapi Data Penilaian Internal an {{$kerjainternal->internals->nama_debitur}}</b></h5><br><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('kerjainternal.update', $kerjainternal)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        <div class="row">
          
           
            <div class="input-field col s12">
                <input type="text" name="tanggal_penilaian" class="datepicker" 
                value="{{$kerjainternal->tanggal_penilaian ?? old('tanggal_penilaian')}}">
                <label for="icon_prefix">Tanggal Inspeksi/Penilaian</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="pendamping" class="form-control" 
                placeholder="Pendamping OTS/Inspeksi" value="{{$kerjainternal->pendamping ?? old('pendamping')}}">
                <label for="">Pendamping OTS/Inspeksi</label>
            </div>
          
            <div class="input-field col s12">
                <select name="peruntukan" id="peruntukan" class="validate">
                    <option value="{{$kerjainternal->peruntukan?? old('peruntukan')}}" selected>{{$kerjainternal->peruntukan}}</option>
                    <option value="Rumah Tinggal">Rumah Tinggal</option>
                    <option value="Pabrik">Pabrik</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Tanah Kosong">Tanah Kosong</option>
                    <option value="Ruko">Ruko</option>
                    <option value="Kios">Kios</option>
                    <option value="Gudang">Gudang</option>
                    <option value="Sawah">Sawah</option>
                </select>
                <label for="">Peruntukan Objek</label>
            </div>
   
            <div class="input-field col s12">    
                <select name="kawasan"  class="validate">
                    <option value="{{$kerjainternal->kawasan?? old('kawasan')}}" selected>{{$kerjainternal->kawasan}}</option>  
                    <option value="Pemukiman">Pemukiman</option>
                    <option value="Perdagangan">Perdagangan</option>
                    <option value="Pertanian Perkebunan">Pertanian/Perkebunan</option>
                    <option value="Industri">Industri</option>
                    <option value="Campuran">Campuran</option>
                </select>
                <label for="">Kawasan</label>
            </div>

            <div class="input-field col s12">
                <select name="pendekatan"  class="validate">
                    <option value="{{$kerjainternal->pendekatan?? old('pendekatan')}}" selected>{{$kerjainternal->pendekatan}}</option>  
                    <option value="Pasar">Pasar</option>
                    <option value="Biaya">Biaya</option>
                    <option value="Pendapatan">Pendapatan</option>
                    <option value="Pendapatan dan Biaya">Pendapatan & Biaya</option>
                </select>
                <label for="">Pendekatan Penilaian</label>
            </div>

            <div class="input-field col s12">    
                <select name="bentuk_tanah"  class="validate">
                    <option value="{{$kerjainternal->bentuk_tanah?? old('bentuk_tanah')}}" selected>{{$kerjainternal->bentuk_tanah}}</option>  
                    <option value="Persegi">Persegi</option>
                    <option value="Trapesium">Trapesium</option>
                    <option value="Segitiga">Segitiga</option>
                    <option value="Persegi Panjang">Persegi Panjang</option>
                    <option value="Tidak Beraturan">Tidak Beraturan</option>
                </select>
                <label for="">Bentuk Tanah</label>
            </div>


            <div class="input-field col s12">
                <select name="posisi"  class="form-control">
                    <option value="{{$kerjainternal->posisi?? old('posisi')}}" selected>{{$kerjainternal->posisi}}</option>  
                    <option value="Hook">Hook</option>
                    <option value="Tengah">Tengah</option>
                    <option value="Kuldesak">Kuldesak</option>
                </select>
                <label for="">Posisi</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="frontage" class="form-control" 
                placeholder="Lebar frontage objek" value="{{$kerjainternal->frontage ?? old('frontage')}}">
                <label for="">Lebar Frontage</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="lebar_jalan" class="form-control" 
                placeholder="Lebar Jalan objek" value="{{$kerjainternal->lebar_jalan ?? old('lebar_jalan')}}">
                <label for="">Lebar Jalan</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="elevasi" class="validate" 
                placeholder="Elevasi dari jalan (jika lebih rendah isi minus)" value="{{$kerjainternal->elevasi ?? old('elevasi')}}">
                <label for="">Elevasi Tanah</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_tanah" class="form-control" 
                placeholder="Luas Tanah Total" value="{{$kerjainternal->luas_tanah ?? old('luas_tanah')}}">
                <label for="">Luas Tanah Total</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="luas_bangunan" class="form-control" 
                placeholder="Luas Bangunan Total" value="{{$kerjainternal->luas_bangunan ?? old('luas_bangunan')}}">
                <label for="">Luas Bangunan Total</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="jumlah_lantai" class="form-control" 
                placeholder="Masukkan jumlah lantai bangunan" value="{{$kerjainternal->jumlah_lantai ?? old('jumlah_lantai')}}">
                <label for="">Jumlah Lantai Bangunan</label>
            </div>

            

            <div class="input-field col s12">
                <input type="text" name="alamat" class="form-control" 
                placeholder="Masukkan Nama Jalan, Perumahan, Blok/Nomor Bangunan Rt/Rw" value="{{$kerjainternal->alamat ?? old('alamat')}}">
                <label for="">Alamat Objek</label>
            </div>

            <div class="input-field col s12">
            <select name="province" id="province" class="browser-default">
                <option value="{{$kerjainternal->province ?? old('province')}}" selected>{{$kerjainternal->province ?? ('Pilih Provinsi')}}</option>
                @foreach ($provinces as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            
            </div>           
            
            <div class="input-field col s12">
            <select name="city" id="city" class="browser-default">
                <option value="{{$kerjainternal->city ?? old('city')}}"selected>{{ $kerjainternal->city ?? ('Pilih Kota/Kab')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="districs" id="districs" class="browser-default">
                <option value="{{$kerjainternal->districs ?? old('districs')}}"selected>{{ $kerjainternal->districs ?? ('Pilih Kecamatan')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="villages" id="villages" class="browser-default">
                <option value="{{$kerjainternal->villages ?? old('villages')}}"selected>{{ $kerjainternal->villages ?? ('Pilih Kel/Desa')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
                <input type="text" name="koordinat" class="form-control" 
                placeholder="Contoh format: (-5.1506910, 119.4156661) atau langsung copas dari maps" 
                value="{{$kerjainternal->koordinat ?? old('koordinat')}}">
                <label for="">Koordinat</label>
            </div>

            <div class="input-field col s12"> 
                <input type="text" id="nilai_pasar" onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nilai_pasar" class="form-control" 
                placeholder="Nilai Pasar Objek" value="{{$kerjainternal->nilai_pasar ?? old('nilai_pasar')}}">
                <label for="">Nilai Pasar Objek</label>
            </div>

            <div id="np_permeter" class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="np_permeter" class="form-control" 
                placeholder="Nilai permeter tanah/ruko" value="{{$kerjainternal->np_permeter ?? old('np_permeter')}}">
                <label for="">Nilai Permeter Tanah/Bangunan Ruko</label>
            </div>

            <div id="nilai_sm" class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nilai_sm" class="form-control" 
                placeholder="Input nilai setelah safety margin" value="{{$kerjainternal->nilai_sm ?? old('nilai_sm')}}">
                <label for="">Nilai Setelah Safety Margin</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nilai_likuidasi" class="form-control" 
                placeholder="Nilai Likuidasi Objek" value="{{$kerjainternal->nilai_likuidasi ?? old('nilai_likuidasi')}}">
                <label for="">Nilai Likuidasi Objek</label>
            </div>
        
           
        
            <!-- <div class="input-field col s6">
                <input type="file" name="gambar" class="form-control"  placeholder="tampak depan"
                value="{{$kerjainternal->tampak_depan ?? old('tampak_depan')}}">
            </div> -->
            

            <div class="input-field col s12" >
                <textarea name="keterangan"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$kerjainternal->keterangan ?? old('keterangan')}}</textarea>
                <label for="">Catatan Untuk Objek Ini</label>
            </div>

            <div class="input-field col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="gambar_depan">
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
    $(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#province').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.city") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#city').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                  
                    $('#city').append(new Option(nama, id))
                })
            }
        })
    });
});

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#city').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.districs") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#districs').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                    $('#districs').append(new Option(nama, id))
                })
            }
        })
    });
});

$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#districs').on('change', function() {
        $.ajax({
            url: '{{ route("kerjareview.villages") }}',
            method: 'POST',
            data: {id: $(this).val()},
            success: function (response) {
                $('#villages').empty();
                    console.log(response);
                $.each(response, function (id, nama) {
                    $('#villages').append(new Option(nama, id))
                })
            }
        })
    });
});

</script>

@endpush



