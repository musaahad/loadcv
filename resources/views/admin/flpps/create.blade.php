@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data Inspeksi FLPP</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.flpps.store')}}" method="POST">
            @csrf

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama Debitur</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan nama (calon) debitur" value="{{ old('nama_debitur')}}">
                @error('nama_debitur')
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
                placeholder="Masukkan nomor surat BU" value="{{ old('nosuratbu')}}">
                @error('nosuratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_suratbu') has-error @enderror">
                <label for="">Tanggal Surat BU</label>
                <input type="date" name="tanggal_suratbu" class="form-control" 
                placeholder="Tanggal Surat BU" value="{{ old('tanggal_suratbu')}}">
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
          
            <div class="form-group @error('developer_id') has-error @enderror">
                <label for="">Developer</label>
                <select name="developer_id"  class="form-control select2">
                    @foreach ($developer as $developers)
                    <option value="{{$developers->id }}">{{$developers->name}}</option>
                    @endforeach
                </select>
                @error('developer_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <!-- <div class="form-group @error('developer') has-error @enderror">
                <label for="">Nama Developer</label>
                <input type="text" name="developer" class="form-control" 
                placeholder="Masukkan nama developer" value="{{ old('developer')}}">
                @error('developer')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div> -->

            <div class="form-group @error('perumahan') has-error @enderror">
                <label for="">Nama Perumahan</label>
                <input type="text" name="perumahan" class="form-control" 
                placeholder="Masukkan nama perumahan" value="{{ old('perumahan')}}">
                @error('perumahan')
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

            <!-- <div class="form-group @error('jumlah_objek') has-error @enderror">
                <label for="">Jumlah Objek</label>
                <input type="number" name="jumlah_objek" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ old('jumlah_objek')}}">
                @error('jumlah_objek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div> -->

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
