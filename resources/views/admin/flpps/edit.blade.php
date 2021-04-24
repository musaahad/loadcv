@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Inspeksi FLPP</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.flpps.update', $flpp)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama Debitur</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan nama debitur" value="{{$flpp->nama_debitur ?? old('nama_debitur') }}">
                @error('nama_debitur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('users_id') has-error @enderror">
                <label for="">PIC</label><br>
                <select name="users_id"  class="form-control select2">
                    @foreach ($users as $user)
                    <option value="{{$user->id }}"
                    @if($user->id === $flpp->users_id)
                        selected
                    @endif
                    >{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('bus_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="bus_id"  class="form-control select2">
                    @foreach ($bus as $bu)
                    <option value="{{$bu->id }}"
                    @if($bu->id === $flpp->bus_id)
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
                <label for="">Nama Debitur</label>
                <input type="text" name="nosuratbu" class="form-control" 
                placeholder="Masukkan nomor surat BU" value="{{$flpp->nosuratbu ?? old('nosuratbu') }}">
                @error('nama_debitur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_suratbu') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_suratbu" class="form-control" 
                placeholder="Input tanggal surat BU" value="{{ $flpp->tanggal_suratbu ?? old('tanggal_suratbu')}}">
                @error('tanggal_suratbu')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_terima') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_terima" class="form-control" 
                placeholder="Input tanggal terima surat" value="{{ $flpp->tanggal_terima ?? old('tanggal_terima')}}">
                @error('tanggal_terima')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('developer_id') has-error @enderror">
                <label for="">Developer</label>
                <select name="developer_id"  class="form-control select2">
                    @foreach ($developer as $developers)
                    <option value="{{$developers->id }}"
                    @if($developers->id === $flpp->developer_id)
                        selected
                    @endif
                    >{{$developers->name}}</option>
                    @endforeach
                </select>
                @error('developers_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('perumahan') has-error @enderror">
                <label for="">Nama Perumahan</label>
                <input type="text" name="perumahan" class="form-control" 
                placeholder="Masukkan nama perumahan" value="{{$flpp->perumahan ?? old('perumahan') }}">
                @error('perumahan')
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
                    <option value="{{old('status')?? $flpp->status}}" selected>{{$flpp->status ?? old('status')}}</option>  
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
                placeholder="Tuliskan keterangan">{{ $flpp->keterangan ?? old('keterangan')}}</textarea>
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