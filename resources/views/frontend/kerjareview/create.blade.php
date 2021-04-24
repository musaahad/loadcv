@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center;"><b>Lengkapi Data Review LPA an {{$kerjareview->reviews->nama_debitur}}</b></h5><br><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('kerjareview.update', $kerjareview)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        <div class="row">
          
            <div class="input-field col s12">
                <input type="text" name="tanggal_lengkap" class="datepicker" 
                value="{{$kerjareview->tanggal_lengkap ?? old('tanggal_lengkap')}}">
                <label for="icon_prefix">Tanggal Lengkap Data</label>
            </div>
          
            <div class="input-field col s12">
                <input type="text" name="tanggal_inspeksi" class="datepicker" 
                value="{{$kerjareview->tanggal_inspeksi ?? old('tanggal_inspeksi')}}">
                <label for="icon_prefix">Tanggal Inspeksi</label>
            </div>
           
            <div class="input-field col s12">
                <input type="text" name="tanggal_penilaian" class="datepicker" 
                value="{{$kerjareview->tanggal_penilaian ?? old('tanggal_penilaian')}}">
                <label for="icon_prefix">Tanggal Penilaian</label>
            </div>
          
            <div class="input-field col s12">
                <select name="peruntukan" id="peruntukan" class="form-control">
                    <option value="{{$kerjareview->peruntukan?? old('peruntukan')}}" selected>{{$kerjareview->peruntukan}}</option>
                    <option value="Tanah bangunan">Tanah & Bangunan</option>
                    <option value="Tanah bangunan beserta mesin atau SPL">Tanah, Bangunan & Mesin/SPL</option>
                    <option value="Tanah">Tanah</option>
                    <option value="Ruko">Ruko</option>
                    <option value="Kios">Kios</option>
                    <option value="Gudang">Gudang</option>
                    <option value="Sawah">Sawah</option>
                </select>
                <label for="">Jenis Objek</label>
            </div>

            <div class="input-field col s12">
                <select name="pendekatan"  class="form-control">
                    <option value="{{$kerjareview->pendekatan?? old('pendekatan')}}" selected>{{$kerjareview->pendekatan}}</option>  
                    <option value="Pasar">Pasar</option>
                    <option value="Biaya">Biaya</option>
                    <option value="Pendapatan">Pendapatan</option>
                    <option value="Pendapatan dan Biaya">Pendapatan & Biaya</option>
                </select>
                <label for="">Pendekatan Penilaian</label>
            </div>

            <div class="input-field col s12">    
                <select name="bentuk_tanah"  class="form-control">
                    <option value="{{$kerjareview->bentuk_tanah?? old('bentuk_tanah')}}" selected>{{$kerjareview->bentuk_tanah}}</option>  
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
                    <option value="{{$kerjareview->posisi?? old('posisi')}}" selected>{{$kerjareview->posisi}}</option>  
                    <option value="Hook">Hook</option>
                    <option value="Tengah">Tengah</option>
                    <option value="Kuldesak">Kuldesak</option>
                </select>
                <label for="">Posisi</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="lt_total" class="form-control" 
                placeholder="Luas Tanah Total" value="{{$kerjareview->lt_total ?? old('lt_total')}}">
                <label for="">Luas Tanah Total</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="lb_total" class="form-control" 
                placeholder="Luas bangunan total" value="{{$kerjareview->lb_total ?? old('lb_total')}}">
                <label for="">Luas Bangunan Total</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="frontage" class="form-control" 
                placeholder="Lebar frontage objek" value="{{$kerjareview->frontage ?? old('frontage')}}">
                <label for="">Lebar Frontage</label>
            </div>

            <div class="input-field col s12">
                <input type="number" name="lebar_jalan" class="form-control" 
                placeholder="Lebar Jalan objek" value="{{$kerjareview->lebar_jalan ?? old('lebar_jalan')}}">
                <label for="">Lebar Jalan</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="alamat" class="form-control" 
                placeholder="Masukkan Nama Jalan, Perumahan, Blok/Nomor Bangunan Rt/Rw" value="{{$kerjareview->alamat ?? old('alamat')}}">
                <label for="">Alamat Objek</label>
            </div>

            <div class="input-field col s12">
            <select name="province" id="province" class="browser-default">
                <option value="{{$kerjareview->province ?? old('province')}}" selected>{{$kerjareview->province ?? ('Pilih Provinsi')}}</option>
                @foreach ($provinces as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                @endforeach
            </select>
            
            </div>           
            
            <div class="input-field col s12">
            <select name="city" id="city" class="browser-default">
                <option value="{{$kerjareview->city ?? old('city')}}"selected>{{ $kerjareview->city ?? ('Pilih Kota/Kab')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="districs" id="districs" class="browser-default">
                <option value="{{$kerjareview->districs ?? old('districs')}}"selected>{{ $kerjareview->districs ?? ('Pilih Kecamatan')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
            <select name="villages" id="villages" class="browser-default">
                <option value="{{$kerjareview->villages ?? old('villages')}}"selected>{{ $kerjareview->villages ?? ('Pilih Kel/Desa')}}</option>
            </select>
            </div>

            <div class="input-field col s12">
                <input type="text" name="koordinat" class="form-control" 
                placeholder="Masukkan Koordinat. Contoh format: (-5.150691031217126, 119.41566613966022) atau langsung copas dari maps" 
                value="{{$kerjareview->koordinat ?? old('koordinat')}}">
                <label for="">Koordinat</label>
            </div>

            <div class="input-field col s12"> 
                <input type="text" id="npt" onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="npt" class="form-control" 
                placeholder="Nilai Pasar Objek" value="{{$kerjareview->npt ?? old('npt')}}">
                <label for="">Nilai Pasar Objek</label>
            </div>

            <div id="np_permeter" class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="np_permeter" class="form-control" 
                placeholder="Nilai permeter tanah/ruko" value="{{$kerjareview->np_permeter ?? old('np_permeter')}}">
                <label for="">Nilai Permeter Tanah/Bangunan Ruko</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nlt" class="form-control" 
                placeholder="Nilai Likuidasi Objek" value="{{$kerjareview->nlt ?? old('nlt')}}">
                <label for="">Nilai Likuidasi Objek</label>
            </div>
        
            <div class="input-field col s12">
                <textarea name="keterangan"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$kerjareview->keterangan ?? old('keterangan')}}</textarea>
                <label for="">Catatan Untuk Objek Ini</label>
            </div>

            <div class="input-field col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="gambar_review">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Foto Tampak Depan">
                </div>
            </div>
            </div>

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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
 
   <script>
    $(document).ready(function(){
     $('.datepicker').datepicker();
    });
    </script>

    <script>
    $(document).ready(function(){
            $('#imb').on('change', function(){
                if (this.value == "Ya") {
                    $('#tgl_imb, #no_imb').show()
                }
            })
        });
    </script>
    
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



