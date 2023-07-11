@extends('layouts.master')

@section('title')
    Contact Us | Hello Linker
@endsection
@section('content')
    <div class="my-5">
        <div class="container mx-auto mt-2">
            <h2 class="h2-responsive text-center font-weight-bold">Contact Us</h2>
            <p class="mt-4 lead text-center">We would love to hear from you! If you have any questions, feedback, or
                suggestions, please feel free to reach out to us through the following channels:</p>

            <div class="d-flex flex-wrap justify-content-center align-items-center mt-8">
                <a href="mailto:admin@hellolinker.net" class="btn btn-primary btn-lg mr-4 mb-4">
                    <i class="far fa-envelope mr-2"></i>
                    Email
                </a>

                <a href="https://www.facebook.com/HelloLinker" class="btn btn-primary btn-lg mr-4 mb-4 mx-3">
                    <i class="fab fa-facebook mr-2"></i>
                    Facebook Page
                </a>

                <a href="https://t.me/hellolinker" class="btn btn-primary btn-lg mr-4 mb-4">
                    <i class="fab fa-telegram-plane mr-2"></i>
                    Telegram
                </a>

                <!-- Add more contact options here -->

            </div>
        </div>
    </div>
@endsection
