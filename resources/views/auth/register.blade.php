@extends('layouts.master-without-nav')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-3">
                <h2 class="text-center">Register</h2>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('auth.register') }}" >
                        @csrf

                        <div class="form-group">
                            <label for="name">Nama</label>

                            <input class="form-control" id="name" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>

                            <input class="form-control" id="email" type="email" name="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>

                            <input class="form-control" id="password" type="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>

                            <input class="form-control" id="password-confirm" type="password" name="password_confirmation">
                        </div>

                        @if ($errors->any())
                        <div class="mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button class="mt-5 rounded bg-primary border-0 py-2 px-3 w-100 text-white" type="submit">Register</button>
                        <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('auth.login') }}">Masuk</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection