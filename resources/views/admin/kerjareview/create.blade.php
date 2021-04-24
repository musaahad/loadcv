@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data Review LPA</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.review.store')}}" method="POST">
            @csrf

            <div class="form-group @error('nama_debitur') has-error @enderror">
                <label for="">Nama Debitur</label>
                <input type="text" name="nama_debitur" class="form-control" 
                placeholder="Masukkan nama (calon) debitur" value="{{ old('nama_debitur')}}">
                @error('nama_debitur')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

          
            <div class="form-group @error('kjpp_id') has-error @enderror">
                <label for="">KJPP</label>
                <select name="kjpp_id"  class="form-control select2">
                    @foreach ($kjpp as $kjpps)
                    <option value="{{$kjpps->id }}">{{$kjpps->name}}</option>
                    @endforeach
                </select>
                @error('kjpp_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('bu_id') has-error @enderror">
                <label for="">Bisnis Unit</label><br>
                <select name="bu_id"  class="form-control select2">
                    @foreach ($bu as $bus)
                    <option value="{{$bus->id }}">{{$bus->name}}</option>
                    @endforeach
                </select>
                @error('bu_id')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('lokasi_id') has-error @enderror">
                <label for="">Lokasi</label>
                <select name="lokasi_id"  class="form-control select2">
                    @foreach ($lokasi as $lokasis)
                    <option value="{{$lokasis->id }}">{{$lokasis->name}}</option>
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
                    <option value="{{$user->id }}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('users_id')
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

            <div class="form-group @error('tanggal_order') has-error @enderror">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tanggal_order" class="form-control" 
                placeholder="Input Jumlah Objek" value="{{ old('tanggal_order')}}">
                @error('tanggal_order')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('status_id') has-error @enderror">
                <label for="">Status</label>
                <select name="status_id"  class="form-control select2">
                    @foreach ($status as $statuss)
                    <option value="{{$statuss->id }}">{{$statuss->name}}</option>
                    @endforeach
                </select>
                @error('status_id')
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
