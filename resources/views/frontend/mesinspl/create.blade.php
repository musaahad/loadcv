@extends('frontend.templates.default')

@section('content')

<div class="box">
    <div class="box-header">
        <h5 class="box-title" style="text-align:center; color:dark-blue"><b>Data Mesin/SPL objek ({{$mesinspl->kerjareviews->peruntukan}}) lokasi di {{$mesinspl->kerjareviews->alamat}}</b></h5><br>
    </div>
</div>
   <div class="box-body">
    <form action="{{ route('mesinspl.update', $mesinspl)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">   

            <div class="input-field col s12">
                <input disabled value="{{number_format($mesinspl->kerjareviews->npt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Pasar Objek</label>
            </div>

            <div class="input-field col s12">
                <input disabled value="{{number_format($mesinspl->kerjareviews->nlt)}}" id="disabled"
                type="text" class="validate">
                <label for="disabled">Nilai Likuidasi Objek</label>
            </div>
            
            <div class="input-field col s12">
                <input type="text" name="nama_mesin" class="form-control" 
                placeholder="Masukkan Nama Mesin/SPL" value="{{$mesinspl->nama_mesin ?? old('nama_mesin')}}">
                <label for="">Nama Mesin/SPL</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="spesifikasi" class="form-control" 
                placeholder="Spesifikasi atau Dimensi" value="{{$mesinspl->spesifikasi ?? old('spesifikasi')}}">
                <label for="">Spesifikasi/Dimensi</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="satuan" class="form-control" 
                placeholder="Satuan Spesifikasi/Dimensi" value="{{$mesinspl->satuan ?? old('satuan')}}">
                <label for="">Satuan Spesifikasi/Dimensi</label>
            </div>

            <div class="input-field col s12">
                <select id="ada" class="form-control">
                    <option value=""></option>  
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
                <label for="">Ada Invoice ??</label>
            </div>

            <div class="input-field col s12"  style="display:none" id="invoice">
                <input type="text" name="invoice" class="form-control" 
                placeholder="Nomor Invoice" value="{{$mesinspl->invoice ?? old('invoice')}}">
                <label for="">Nomor Invoice</label>
            </div>

            <div class="input-field col s12"style="display:none" id="tgl_invoice">
                <input type="text" name="tgl_invoice" class="datepicker" 
                value="{{$mesinspl->tgl_invoice ?? old('tgl_invoice')}}">
                <label for="icon_prefix">Tanggal Invoice</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="npm1" class="form-control" 
                placeholder="Nilai Pasar Mesin/SPL" value="{{$mesinspl->npm1 ?? old('npm1')}}">
                <label for="icon_prefix">Nilai Pasar Mesin/SPL</label>
            </div>

            <div class="input-field col s12">
                <input type="text"  onkeydown="return numbersonly(this, event);" 
                onkeyup="javascript:tandaPemisahTitik(this);" name="nlm1" class="form-control" 
                placeholder="Nilai Likuidasi Mesin/SPL" value="{{$mesinspl->nlm1 ?? old('nlm1')}}">
                <label for="icon_prefix">Nilai Likuidasi Mesin/SPL</label>
            </div>

            <div class="input-field col s12">
                <select name="kondisi_spl" class="form-control">
                    <option value="{{$mesinspl->kondisi_spl?? old('kondisi_spl')}}" selected>{{$mesinspl->kondisi_spl}}</option>  
                    <option value="Baru">Baru</option>
                    <option value="Sangat Baik">Sangat Baik</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Scrap">Scrap</option>
                </select>
                <label for="icon_prefix">Kondisi Mesin/SPL</label>
            </div>
        
            <div class="input-field col s12">
                <textarea name="catatan2"  id="textarea1" class="materialize-textarea"
                placeholder="Tuliskan catatan">{{$mesinspl->keterangan1 ?? old('catatan2')}}</textarea>
                <label for="icon_prefix">Catatan Untuk Mesin/SPL Ini</label>
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
            $('#ada').on('change', function(){
                if (this.value == "Ya") {
                    $('#invoice, #tgl_invoice').show()
                }
            })
        });
    </script>
@endpush

@push('select2css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

