@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Verifikasi Progress</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.vercall.update', $vercall)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan Order Review" value="{{$vercall->nama_debitur ?? old('nama_debitur') }}">
                @error('nama_debitur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('BU_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="BU_id"  class="form-control select2">
                    @foreach ($BU as $BUs)
                    <option 
                    value="{{$BUs->id }}"
                    @if($BUs->id === $vercall->BU_id)
                        selected
                    @endif
                    >{{$BUs->name}}</option>
                    @endforeach
                </select>
                @error('BU_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('developers_id') has-error @enderror">
                <label for="">Developer</label>
                <select name="developers_id"  class="form-control select2">
                    @foreach ($developer as $developers)
                    <option value="{{$developers->id }}"
                    @if($developers->id === $vercall->developer_id)
                        selected
                    @endif
                    >{{$developers->name}}</option>
                    @endforeach
                </select>
                @error('developers_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('lokasi_id') has-error @enderror">
                <label for="">Lokasi</label>
                <select name="lokasi_id"  class="form-control select2">
                    @foreach ($lokasi as $lokasis)
                    <option value="{{$lokasis->id }}"
                    @if($lokasis->id === $vercall->lokasi_id)
                        selected
                    @endif
                    >{{$lokasis->name}}</option>
                    @endforeach
                </select>
                @error('lokasi_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('PIC_id') has-error @enderror">
                <label for="">PIC</label><br>
                <select name="PIC_id"  class="form-control select2">
                    @foreach ($PIC as $PICs)
                    <option value="{{$PICs->id }}"
                    @if($PICs->id === $vercall->PIC_id)
                        selected
                    @endif
                    >{{$PICs->name}}</option>
                    @endforeach
                </select>
                @error('PIC_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jumlah_objek') has-error @enderror">
                <label for="">Jumlah Objek</label>
                <input type="number" name="jumlah_objek" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ $vercall->jumlah_objek ?? old('jumlah_objek')}}">
                @error('jumlah_objek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_order') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_order" class="form-control" 
                placeholder="Input Tanggal Terima" value="{{ $vercall->tanggal_order ?? old('tanggal_order')}}">
                @error('tanggal_order')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('status_id') has-error @enderror">
                <label for="">Status</label>
                <select name="status_id"  class="form-control select2">
                    @foreach ($status as $statuss)
                    <option value="{{$statuss->id }}"
                    @if($statuss->id === $vercall->status_id)
                        selected
                    @endif
                    >{{$statuss->name}}</option>
                    @endforeach
                </select>
                @error('status_id')
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

            <div class="form-group @error('keterangan') has-error @enderror">
                <label for="">Keterangan</label>
                <textarea name="keterangan"  row="3" class="form-control" 
                placeholder="Tuliskan keterangan">{{ $vercall->keterangan ?? old('keterangan')}}</textarea>
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