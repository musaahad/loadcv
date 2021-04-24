@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Data Load Review</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.review.update', $review)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan Nama Debitur" value="{{$review->nama_debitur ?? old('nama_debitur') }}">
                @error('nama_debitur')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('bu_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="bu_id"  class="form-control select2">
                    @foreach ($bu as $bus)
                    <option 
                    value="{{$bus->id }}"
                    @if($bus->id === $review->bus_id)
                        selected
                    @endif
                    >{{$bus->name}}</option>
                    @endforeach
                </select>
                @error('bu_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('kjpp_id') has-error @enderror">
                <label for="">KJPP</label>
                <select name="kjpp_id"  class="form-control select2">
                    @foreach ($kjpp as $kjpps)
                    <option value="{{$kjpps->id }}"
                    @if($kjpps->id === $review->kjpps_id)
                        selected
                    @endif
                    >{{$kjpps->name}}</option>
                    @endforeach
                </select>
                @error('kjpp_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('lokasi_id') has-error @enderror">
                <label for="">Lokasi</label>
                <select name="lokasi_id"  class="form-control select2">
                    @foreach ($lokasi as $lokasis)
                    <option value="{{$lokasis->id }}"
                    @if($lokasis->id === $review->lokasi_id)
                        selected
                    @endif
                    >{{$lokasis->name}}</option>
                    @endforeach
                </select>
                @error('lokasis_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('users_id') has-error @enderror">
                <label for="">PIC</label><br>
                <select name="users_id"  class="form-control select2">
                    @foreach ($users as $user)
                    <option value="{{$user->id }}"
                    @if($user->id === $review->users_id)
                        selected
                    @endif
                    >{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('jumlah_objek') has-error @enderror">
                <label for="">Jumlah Objek</label>
                <input type="number" name="jumlah_objek" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ $review->jumlah_objek ?? old('jumlah_objek')}}">
                @error('jumlah_objek')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('tanggal_order') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_order" class="form-control" 
                placeholder="Input Tanggal Terima" value="{{ $review->tanggal_order ?? old('tanggal_order')}}">
                @error('tanggal_order')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('status_id') has-error @enderror">
                <label for="">Status</label>
                <select name="status_id"  class="form-control select2">
                    @foreach ($status as $statuss)
                    <option value="{{$statuss->id }}"
                    @if($statuss->id === $review->status_id)
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
                placeholder="Input Tanggal Selesai" value="{{ $review->tanggal_selesai ?? old('tanggal_selesai')}}">
                @error('tanggal_selesai')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('keterangan') has-error @enderror">
                <label for="">Keterangan</label>
                <textarea name="keterangan"  row="3" class="form-control" 
                placeholder="Tuliskan keterangan">{{ $review->keterangan ?? old('keterangan')}}</textarea>
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