@extends('layouts.master-without-nav')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-3">
                <h2 class="text-center">Login</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.authenticate') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>

                            <input class="form-control" id="email" type="email" name="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>

                            <input class="form-control" id="password" type="password" name="password">
                        </div>

                        @if(session('loginError'))
                        <div class="mt-3">
                            <p class="text-danger">{{ session('loginError') }}</p>
                        </div>
                        @endif
                        

                        <button class="mt-5 rounded bg-primary border-0 py-2 px-3 w-100 text-white" type="submit">Login</button>
                        <p class="text-center mt-3">Belum mempunyai akun? <a class="text-decoration-none" href="{{ route('auth.register') }}">Daftar</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection