@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center text-center">
        
           
        
        <div class="col-md-8" style="padding-top: 10px">
         
            <div class="row  p-3">
                <div class="col-sm-2 "></div>
                <div class="col-sm-8 "><div ><img src ="{{asset('/admin/dist/img/scsLogo20.jpg')}}" class="thumbnail" style="width: 100px; " alt="">
               <p> <br> <b class="text-info"> Complaint Management System</b></p>
                </div></div>
                <div class="col-sm-2 "></div>
               </div>
            <div class="card" >
                
                <div class="card-header " style="text-align: center; background-color:#3490dc; color:white ">User Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="log_id" class="col-md-3 col-form-label text-md-right">{{ __('Login ID') }}</label>

                            <div class="col-md-6">
                                <input id="log_id" class="form-control @error('log_id') is-invalid @enderror" name="log_id" value="" required autofocus>

                                @error('log_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text password-toggle" id="password-toggle">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                
                                <button type="submit" class="btn  btn-outline-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
