@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center; color:dark-blue"><b>Data untuk objek ({{$datapasar->kerjareviews->peruntukan}}) lokasi di {{$datapasar->kerjareviews->alamat}} </b></h5><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('datapasar.update', $datapasar)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">   

            <div class="input-field col s12">
                <input disabled value="{{date('d M Y', strtotime($datapasar->kerjareviews->tanggal_inspeksi))}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Tanggal Inspeksi</label>
            </div>

            <div class="input-field col s12">
                <input disabled value="{{number_format($datapasar->kerjareviews->npt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Pasar Objek</label>
            </div>
            
            <div class="input-field col s12">
                <input type="text" name="tanggal_data" class="datepicker" 
                value="{{$datapasar->tanggal_data ?? old('tanggal_data')}}">
                <label for="icon_prefix">Tanggal Data</label>
            </div>
    
            <div class="input-field col s12">
                <select name="peruntukan1" id="peruntukan" class="multiple">
                    <option value="{{$datapasar->peruntukan1?? old('peruntukan1')}}" selected>{{$datapasar->peruntukan1}}</option>
                    <option value="Tanah Bangunan">Tanah & Bangunan</option>
                    <option value="Tanah">Tanah</option>
                    <option value="Ruko">Ruko</option>
                    <option value="Kios">Kios</option>
                    <option value="Gudang">Gudang</option>
                    <option value="Sawah">Sawah</option>
                </select>
                <label for="icon_prefix">Jenis Objek</label>
            </div>

            <div class="input-field col s12">
                
                <input type="text" name="penjual" class="form-control" 
                placeholder="Masukkan Nama Penjual" value="{{$datapasar->penjual ?? old('penjual')}}">
                <label for="icon_prefix">Nama Penjual</label>
            </div>


            <div class="input-field col s12">
                
                <input type="text" name="notelp" class="form-control" 
                placeholder="Masukkan Nomor Telphone Penjual" value="{{$datapasar->notelp ?? old('notelp')}}">
                <label for="icon_prefix">No. Telp Penjual</label>
            </div>     

            <div class="input-field col s12">
                <select name="legalitas1" id="legalitas1" class="form-control">
                    <option value="{{$datapasar->legalitas1?? old('legalitas1')}}" selected>{{$datapasar->legalitas1}}</option>  
                    <option value="SHM">SHM</option>
                    <option value="SHGB">SHGB</option>
                    <option value="SHMASRS">SHMASRS</option>
                    <option value="Girik">Girik</option>
                    <option value="Belum ada">Belum ada</option>
                </select>
                <label for="icon_prefix">Jenis Legalitas</label>
            </div>

            <div class="input-field col s12">
               
                <select name="bentuk_tanah1"  class="form-control">
                    <option value="{{$datapasar->bentuk_tanah1?? old('bentuk_tanah1')}}" selected>{{$datapasar->bentuk_tanah1}}</option>  
                    <option value="Persegi">Persegi</option>
                    <option value="Trapesium">Trapesium</option>
                    <option value="Segitiga">Segitiga</option>
                    <option value="Persegi Panjang">Persegi Panjang</option>
                    <option value="Tidak Beraturan">Tidak Beraturan</option>
                </select>
                <label for="">Bentuk Tanah</label>
            </div>

            <div class="input-field col s12">
                
                <input type="number" name="frontage1" class="form-control" 
                placeholder="Input lebar frontage (m)" value="{{$datapasar->frontage1 ?? old('frontage1')}}">
                <label for="icon_prefix">Lebar Frontage</label>
            </div>

            <div class="input-field col s12">
                
                <select name="posisi1"  class="form-control">
                    <option value="{{$datapasar->posisi1?? old('posisi1')}}" selected>{{$datapasar->posisi1}}</option>  
                    <option value="Hook">Hook</option>
                    <option value="Tengah">Tengah</option>
                    <option value="Kuldesak">Kuldesak</option>
                </select>
                <label for="">Posisi</label>
            </div>
           
            
            <div class="input-field col s12">
                
                <input type="number" name="lebar_jalan1" class="form-control" 
                placeholder="Input lebar jalan" value="{{$datapasar->lebar_jalan1 ?? old('lebar_jalan1')}}">
                <label for="icon_prefix">Lebar Jalan</label>
            </div>

            <div class="input-field col s12">
                
                <input type="number" name="jarak_aktiva" class="form-control" 
                placeholder="Jarak dengan objek penilaian" value="{{$datapasar->jarak_aktiva ?? old('jarak_aktiva')}}">
                <label for="icon_prefix">Jarak Data dengan Objek</label>
            </div>

            <div class="input-field col s12">
                
                <input type="number" name="luas_tanah1" class="form-control" 
                placeholder="Luas Tanah (m2)" value="{{$datapasar->luas_tanah1 ?? old('luas_tanah1')}}">
                <label for="icon_prefix">Luas Tanah</label>
            </div>

            <div class="input-field col s12" style="display:none" id="luas_bangunan" >
               
                <input type="number" name="luas_bangunan1" class="form-control" 
                placeholder="Luas Bangunan (m2)" value="{{$datapasar->luas_bangunan1 ?? old('luas_bangunan1')}}">
                <label for="icon_prefix">Luas Bangunan</label>
            </div>
 
            

            <div class="input-field col s12">
            <select name="province1" id="province" class="browser-default">
                <option value="{{$datapasar->province1 ?? old('province1')}}" selected>{{$datapasar->provinces1 ?? ('Pilih Provinsi')}}</option>
                @foreach ($provinces as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            </div>           
            
            <div class="input-field col s12">
            <select name="city1" id="city" class="browser-default">
                <option value="{{$datapasar->city1 ?? old('city1')}}"selected>{{$datapasar->city1 ??  ('Pilih Kota/Kab')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="districs1" id="districs" class="browser-default">
                <option value="{{$datapasar->districs1 ?? old('districs1')}}"selected>{{$datapasar->districs1 ??  ('Pilih Kecamatan')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="villages1" id="villages" class="browser-default">
                <option value="{{$datapasar->villages1 ?? old('villages1')}}"selected>{{ $datapasar->villages1 ?? ('Pilih Kel/Desa')}}</option>
            </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="alamat1" class="form-control" 
                placeholder="Masukkan Nama Jalan, Perumahan, Blok/Nomor Bangunan Rt/Rw" value="{{$datapasar->alamat1 ?? old('alamat1')}}">
                <label for="icon_prefix">Alamat Data Pembanding</label>
            </div>

            <!-- <div class="input-field col s6">
                <input type="text" name="villages1" class="form-control" 
                placeholder="Masukkan Nama Kelurahan" value="{{$datapasar->villages1 ?? old('villages1')}}">
                <label for="icon_prefix">Kelurahan</label>
            </div> -->

            <div class="input-field col s12">
                <input type="text" name="koordinat1" class="form-control" 
                placeholder="Masukkan Koordinat. Contoh format: (-5.150691031217126, 119.41566613966022) atau langsung copas dari maps" 
                value="{{$datapasar->koordinat1 ?? old('koordinat1')}}">
                <label for="icon_prefix">Koordinat</label>
            </div>

            <div class="input-field col s12"> 
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="harga_penawaran" class="form-control" 
                placeholder="Input harga penawaran (Rp)" value="{{$datapasar->harga_penawaran ?? old('harga_penawaran')}}">
                <label for="icon_prefix">Harga Penawaran</label>
            </div>
        
            <div class="input-field col s12">
                <textarea name="keterangan1"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$datapasar->keterangan1 ?? old('keterangan1')}}</textarea>
                <label for="icon_prefix">Catatan Untuk Data Ini</label>
            </div>

            <div class="input-field col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="gambar">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Foto Data">
                </div>
            </div>
            </div>
            
           <!-- <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>--->
            <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit" name="action">Simpan
                <i class="material-icons right">save</i>
            </button>
            </div>
        </div>
    </form>
    </div>

  
@endsection

@push('scripts')
    <script>
 
        $(document).ready(function(){
            $('#peruntukan').on('change', function(){
                if (this.value == "Tanah Bangunan") {
                    $('#luas_bangunan').show()
                }
                if (this.value == "Gudang") {
                    $('#luas_bangunan').show()
                }
                if (this.value == "Ruko") {
                    $('#luas_bangunan').show()
                }
                if (this.value == "Kios") {
                    $('#luas_bangunan').show()
                }
    
            })
        });
       
    </script> 
   <!-- <script>
    $(document).ready(function(){
     $('.datepicker').datepicker({
     });
    });
    </script> -->

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



