@extends('layouts.master')

@section('title')
    Login
@endsection


@section('content')
    <div class="container mt-5">
        <div class="row mt-5 ">
            <div class="col-md-3"></div>
            <div class="col-md-6 mb-4 ">
                <div class="d-flex justify-content-center annimateLogo">
                    <img class=" rounded rounded-circle" src="{{ asset('user/img/linklogo.jpg') }}" height="100"
                        alt="">
                </div>
                <form class="mt-3 card p-5 shadow bg-dark" method="POST" action="{{ route('login') }}">
                    <h5 class="text-center">Login Form</h5>
                    <div class="line-mf"></div>
                    @if ($errors->any())
                        <div class="my-2">
                            @foreach ($errors->all() as $error)
                                <span class=" text-danger">-{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input value="{{ old('email') }}" type="email" name="email" id="form2Example1"
                            class="form-control " required autocomplete="off">
                        <label class="form-label" for="form2Example1" style="margin-left: 0px">
                            <span language='eng'>Email</span>
                        </label>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example2" class="form-control" required
                            autocomplete="off">
                        <label class="form-label" for="form2Example2" style="margin-left: 0px">
                            <span language='eng'>Password</span>
                        </label>
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remimbercheck">
                                <label class="form-check-label" for="remimbercheck">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('register') }}">Register Now</a>
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
                    <!-- Register buttons -->
                    {{-- <div class="text-center">
                        <p>Not a member? <a href="{{route('register')}}">Register</a></p>
                        <p>or sign up with:</p>
                        <div id="my-signin2"></div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.PopUpAdsCenter').addClass('d-none');
            $('.PopUpAdsBottom').addClass('d-none');
            $('.searchForm').fadeOut(1000);
            $('input').focus();
        });

        function onSuccess(googleUser) {
            console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
        }

        function onFailure(error) {
            console.log(error);
        }

        function renderButton() {
            gapi.signin2.render('my-signin2', {
                'scope': 'profile email',
                'width': 240,
                'height': 50,
                'longtitle': true,
                'theme': 'dark',
                'onsuccess': onSuccess,
                'onfailure': onFailure
            });
        }
    </script>
@endpush
