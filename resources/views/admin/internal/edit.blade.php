@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Penilaian Internal</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.internal.update', $internal)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan Order Review" value="{{$internal->nama_debitur ?? old('nama_debitur') }}">
                @error('nama_debitur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('cif') has-error @enderror">
                <label for="">CIF</label>
                <input type="text" name="cif" class="form-control" 
                placeholder="Masukkan CIF Debitur" value="{{$internal->cif ?? old('cif') }}">
                @error('cif')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('bus_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="bus_id"  class="form-control select2">
                    @foreach ($bus as $bu)
                    <option value="{{$bu->id }}"
                    @if($bu->id === $internal->bus_id)
                        selected
                    @endif
                    >{{$bu->name}}</option>
                    @endforeach
                </select>
                @error('bus_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group @error('nosuratbu') has-error @enderror">
                <label for="">Nomor Surat BU</label>
                <input type="text" name="nosuratbu" class="form-control" 
                placeholder="Masukkan Nomor Surat BU" value="{{$internal->nosuratbu ?? old('nosuratbu')}}">
                @error('nosuratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('users_id') has-error @enderror">
                <label for="">PIC 1</label>
                <select name="users_id"  class="form-control select2">
                    @foreach ($users as $user)
                    <option value="{{$user->id }}"
                    @if($user->id === $internal->users_id)
                        selected
                    @endif
                    >{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('users_id1') has-error @enderror">
                <label for="">PIC 2</label>
                <select name="users_id1"  class="form-control select2">
                    @foreach ($users as $user)
                    <option value="{{$user->id }}"
                    @if($user->id === $internal->users_id1)
                        selected
                    @endif
                    >{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id1')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tujuan') has-error @enderror">
                <label for="">Tujuan Penilaian</label>
                <select name="tujuan" class="form-control select2">
                    <option value="{{$internal->tujuan ?? old('tujuan')}}" selected>{{$internal->tujuan}}</option>  
                    <option value="Penjaminan Kredit">Penjaminan Kredit</option>
                    <option value="Lelang Hak Tanggungan">Lelang Hak Tanggungan</option>
                    <option value="Penilaian Ulang">Penilaian Ulang</option>
                    <option value="Penebusan Agunan">Penebusan Agunan</option>
                </select>
                @error('tujuan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jumlah_objek') has-error @enderror">
                <label for="">Jumlah Objek</label>
                <input type="number" name="jumlah_objek" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ $internal->jumlah_objek ?? old('jumlah_objek')}}">
                @error('jumlah_objek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_suratbu') has-error @enderror">
                <label for="">Tanggal Surat BU</label>
                <input type="date" name="tanggal_suratbu" class="form-control" 
                placeholder="Input Tanggal Surat BU" value="{{$internal->tanggal_suratbu ?? old('tanggal_suratbu')}}">
                @error('tanggal_suratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_terima') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_terima" class="form-control" 
                placeholder="Input Tanggal Terima" value="{{ $internal->tanggal_terima ?? old('tanggal_terima')}}">
                @error('tanggal_terima')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group @error('tanggal_selesai') has-error @enderror">
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" 
                placeholder="Input Tanggal Selesai" value="{{ old('tanggal_selesai')}}">
                @error('tanggal_selesai')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('status') has-error @enderror">
                <label for="">Status</label>
                <select name="status" class="form-control select2">
                    <option value="{{$internal->status ?? old('status')}}" selected>{{$internal->status}}</option>  
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
                placeholder="Tuliskan keterangan">{{ $internal->keterangan ?? old('keterangan')}}</textarea>
                @error('keterangan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" value="Ubah" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection