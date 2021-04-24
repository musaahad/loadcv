@extends('frontend.templates.default')

@section('content')
    <div class="container">
        <h3>Register</h3>
        <form action="{{ route ('register') }}" class="col s12" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input type="text" class="@error('name') invalid @enderror" name="name"
                    value="{{old ('name')}}">
                    <label for="">Nama</label>
                    @error('name')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="email" class="validate @error('email') invalid @enderror" name="email"
                    value="{{old ('email')}}">
                    <label for="">E-mail</label>
                    @error('email')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">verified_user</i>
                    <input type="text" class="validate @error('nip') invalid @enderror" name="nip"
                    value="{{old ('nip')}}">
                    <label for="">NIP</label>
                    @error('nip')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12 ">
                   <i class="material-icons prefix">work</i>
                    <select name="jabatan" class="validate @error('jabatan') invalid @enderror">
                        <option value=""></option>
                        <option value="Team Leader">Team Leader</option>
                        <option value="Officer">Officer</option>
                        <option value="Pelaksana">Pelaksana</option>
                    </select>
                    <label for="">Jabatan</label>
                    @error('jabatan')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12 ">
                   <i class="material-icons prefix">wc</i>
                    <select name="panggilan" class="validate @error('panggilan') invalid @enderror">
                        <option value=""></option>
                        <option value="Bro">Laki-Laki</option>
                        <option value="Sis">Perempuan</option>
                    </select>
                    <label for="">Jenis Kelamin</label>
                    @error('panggilan')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" class="@error('password') invalid @enderror" name="password"
                    value="">
                    <label for="">Password</label>
                    @error('password')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">enhanced_encryption</i>
                    <input type="password" class="@error('password_confirmation') invalid @enderror" 
                    name="password_confirmation" value="">
                    <label for="">Password Confirmation</label>
                    @error('password_confirmation')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input field right">
                    <input type="submit" value="Register" class="waves-effect waves-light btn red accent-1">
                </div>
            </div>
        </form>
    </div>
@endsection
