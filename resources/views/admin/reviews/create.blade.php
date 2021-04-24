@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data Review LPA</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.reviews.store')}}" method="POST">
            @csrf

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama Debitur</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan nama (calon) debitur" value="{{ old('nama_debitur')}}">
                @error('nama_debitur')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('cif') has-error @enderror">
                <label for="">CIF</label>
                <input type="text" name="cif" class="form-control" 
                placeholder="Masukkan CIF debitur" value="{{ old('cif')}}">
                @error('cif')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>
        
            <div class="form-group @error('kjpps_id') has-error @enderror">
                <label for="">KJPP</label>
                <select name="kjpps_id"  class="form-control select2">
                    @foreach ($kjpps as $kjpp)
                    <option value="{{$kjpp->id }}">{{$kjpp->name}}</option>
                    @endforeach
                </select>
                @error('kjpps_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('bus_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="bus_id"  class="form-control select2">
                    @foreach ($bus as $bu)
                    <option value="{{$bu->id }}">{{$bu->name}}</option>
                    @endforeach
                </select>
                @error('bus_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('nosuratbu') has-error @enderror">
                <label for="">Nomor Surat BU</label>
                <input type="text" name="nosuratbu" class="form-control" 
                placeholder="Masukkan Nomor Surat BU" value="{{ old('nosuratbu')}}">
                @error('nosuratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_suratbu') has-error @enderror">
                <label for="">Tanggal Surat BU</label>
                <input type="date" name="tanggal_suratbu" class="form-control" 
                placeholder="Input Tanggal Surat BU" value="{{ old('tanggal_suratbu')}}">
                @error('tanggal_suratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_terima') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_terima" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ old('tanggal_terima')}}">
                @error('tanggal_terima')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('no_lpa') has-error @enderror">
                <label for="">Nomor LPA</label>
                <input type="text" name="no_lpa" class="form-control" 
                placeholder="Masukkan Nomor LPA" value="{{ old('no_lpa')}}">
                @error('no_lpa')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_lpa') has-error @enderror">
                <label for="">Tanggal LPA</label>
                <input type="date" name="tanggal_lpa" class="form-control" 
                placeholder="Input Tanggal LPA" value="{{ old('tanggal_lpa')}}">
                @error('tanggal_lpa')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jumlah_objek') has-error @enderror">
                <label for="">Jumlah Objek</label>
                <input type="number" name="jumlah_objek" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ old('jumlah_objek')}}">
                @error('jumlah_objek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tujuan') has-error @enderror">
                <label for="">Tujuan Penilaian</label>
                <select name="tujuan" class="form-control select2">
                    <option value="{{old('tujuan')}}" selected>{{old('tujuan')}}</option>  
                    <option value="Penjaminan Kredit">Penjaminan Kredit</option>
                    <option value="Lelang Hak Tanggungan">Lelang Hak Tanggungan</option>
                    <option value="Penilaian Ulang">Penilaian Ulang</option>
                    <option value="Penebusan Agunan">Penebusan Agunan</option>
                </select>
                @error('tujuan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('users_id') has-error @enderror">
                <label for="">PIC</label><br>
                <select name="users_id"  class="form-control select2">
                    @foreach ($users as $user)
                    <option value="{{$user->id }}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('status') has-error @enderror">
                <label for="">Status</label>
                <select name="status" class="form-control select2">
                    <option value="{{old('status')}}" selected>{{old('status')}}</option>  
                    <option value="On Progress">On Progress</option>
                    <option value="Done">Done</option>
                    <option value="Rejected">Rejected</option>
                </select>
                @error('status')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('keterangan') has-error @enderror">
                <label for="">Keterangan</label>
                <textarea name="keterangan"  row="3" class="form-control" 
                placeholder="Tuliskan keterangan">{{ old('keterangan')}}</textarea>
                @error('keterangan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" value="Tambah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection

@push('select2css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>$('.select2').select2();</script>

@endpush
