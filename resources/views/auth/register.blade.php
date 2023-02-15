@extends('layouts.master')
@section('title')
    Register
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
                <form class="mt-3 card p-5 shadow bg-dark" method="POST" action="{{ route('register') }}">
                    <h5 class="text-center"><span language='eng'>Register Form</span></h5>
                    <div class="line-mf"></div>
                    @if ($errors->any())
                        <ul class="mb-3 p-0">
                            @foreach ($errors->all() as $error)
                                <li class=" text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @csrf
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input value="{{ old('name') }}" type="text" name="name" id="nameInput"
                            class="form-control @error('name') is-invalid @enderror" required autocomplete="off">
                        <label class="form-label" for="nameInput" style="margin-left: 0px">
                            <span language='eng'>Name</span>
                        </label>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input value="{{ old('email') }}" type="email" name="email" id="emailInput"
                            class="form-control  @error('email') is-invalid @enderror" required autocomplete="off">
                        <label class="form-label" for="emailInput" style="margin-left: 0px">
                            <span language='eng'>Email</span>
                        </label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="passwordInput"
                            class="form-control  @error('password') is-invalid @enderror" required autocomplete="off">
                        <label class="form-label" for="passwordInput" style="margin-left: 0px">
                            <span language='eng'>Password</span>
                        </label>
                    </div>
                    <!--Confimr Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password_confirmation" id="CpasswordInput"
                            class="form-control  @error('password_confirmation') is-invalid @enderror" required
                            autocomplete="off">
                        <label class="form-label" for="CpasswordInput" style="margin-left: 0px">
                            <span language='eng'>Confirm Password</span>
                        </label>
                    </div>
                    <!-- Gender input -->
                    <div class="form-outline mb-4">
                        <select name="gender" id="" class=" form-select bg-dark text-light">
                            <option value="">Please select gender ...</option>
                            <option value="male" @if (old('gender') == 'male') selected @endif>Male</option>
                            <option value="female" @if (old('gender') == 'female') selected @endif>Female</option>
                            <option value="rather" @if (old('gender') == 'rather') selected @endif>Rather not to say
                            </option>
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Sign Up
                    </button>

                    <!-- Register buttons -->
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
            if ('{{ $errors->any() }}') {
                $('input').focus();
            }
        });
    </script>
@endpush
