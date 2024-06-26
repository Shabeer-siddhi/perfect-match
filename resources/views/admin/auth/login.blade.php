@extends('admin.layouts.auth')
@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">
                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>
                        <p class="white mb-0">
                            Please use your credentials to login.
                            <br>If you are not a member, please
                            <a href="#" class="white">register</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a href="Dashboard.Default.html">
                            <span class="logo-single"></span>
                        </a>
                        <h6 class="mb-4">Login</h6>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="email" name="email" required
                                    value="admin@admin.com" />
                                <span>E-mail</span>
                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </label>

                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" type="password" name="password" placeholder="" required
                                    value="password" />
                                <span>Password</span>
                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </label>
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- <a href="#">Forget password?</a> --}}
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
