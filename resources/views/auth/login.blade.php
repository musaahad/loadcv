@extends('frontend.templates.default')

@section('content')
    <div class="container">
        <h3>Login</h3>
        <form action="{{ route ('login') }}" class="col s12" method="post">
            @csrf
            <div class="row">
  
               <!-- <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input type="email" class="validate @error('email') invalid @enderror" name="email"
                    value="{{old ('email')}}">
                    <label for="">E-mail Address</label>
                    @error('email')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div> -->
           

                <div class="input-field col s12">
               
                    <i class="material-icons prefix">verified_user</i>
                    <label for="">NIP</label>   
                    <input type="text" class="validate @error('nip') invalid @enderror" name="nip"
                    value="{{old ('nip')}}">
                    
                    @error('nip')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <label for="">Password</label>
                    <input type="password" class="@error('password') invalid @enderror" name="password"
                    value="">
                   
                    @error('password')
                        <span class="helper-text" data-error="{{$message}}"></span>
                    @enderror
                </div>

                

                <div class="input field right">
                    <input type="submit" value="Login" class="waves-effect waves-light btn red accent-1">
                </div>
            </div>
        </form>
        
        <a style="position: relative; top: -55px; left:510px " class="btn btn-link" 
        href="{{ route('password.request') }}">Forgot Your Password?</a>

       
        
    </div>
@endsection
