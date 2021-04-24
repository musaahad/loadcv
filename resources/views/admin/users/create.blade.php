@extends('admin.templates.default')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Data PIC</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('admin.users.store')}}" method="POST">
            @csrf

            <div class="form-group @error('name') has-error @enderror">
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Masukkan Nama PIC" value="{{ old('name')}}">
                @error('name')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('nip') has-error @enderror">
                <label for="">NIP</label>
                <input type="text" name="nip" class="form-control" 
                placeholder="Masukkan NIP PIC" value="{{old('nip')}} ">
                @error('nip')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('panggilan') has-error @enderror">
                <label for="">Panggilan</label><br>
                <select name="panggilan"  class="form-control select2">
                    <option value="">--Panggilan---</option>
                    <option value="Bro">Bro</option>
                    <option value="Sis">Sis</option>
                    <option value="Om">Om</option>
                    <option value="Tante">Tante</option>
                    <option value="Pak">Pak</option>
                    <option value="Buk">Buk</option>
                    <option value="Bang">Bang</option>
                    <option value="Bung">Bung</option>
                </select>
            </div>

            <div class="form-group @error('jabatan') has-error @enderror">
                <label for="">Jabatan</label><br>
                <select name="jabatan"  class="form-control select2">
                    <option value="">--Jabatan---</option>
                    <option value="Pelaksana">Pelaksana</option>
                    <option value="Officer">Officer</option>
                    <option value="Team Leader">Team Leader</option>
                </select>
                @error('jabatan')
                    <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('email') has-error @enderror">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" 
                placeholder="Masukkan email PIC" value="{{old('email') }}">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group @error('password') has-error @enderror">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" 
                placeholder="Masukkan Password Default" >
                @error('password')
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

