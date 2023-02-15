<!DOCTYPE html>

<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {

            margin-top: 150px;

            background-color: black;

        }

        .error-main {

            background-color: black;

            box-shadow: 0px 10px 10px -10px #5D6572;
        }

        .error-main h1 {

            font-weight: bold;

            color: #E4E4E4;

            font-size: 150px;

            text-shadow: 2px 4px 5px #6E6E6E;

        }

        .error-main h6 {

            color: #E4E4E4;

            font-size: 20px;

        }

        .error-main p {

            color: #9897A0;

            font-size: 15px;

        }
    </style>

</head>

<body>



    <div class="container">

        <div class="row text-center">

            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">

                <div class="row">

                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">

                        <h1 class="m-0">404</h1>

                        <h6><span language='eng'>The Link is Primium Link</span><span
                                language="mm">မန်ဘာ၀င်များအတွက်သာဖြစ်ပါသည်</span></h6>

                        <div class="my-3">
                            @if (empty(Auth::user()))
                                <a href="{{ route('register') }}" class="btn btn-primary"><span language='eng'>Create
                                        Account</span><span language="mm">အကောင့်ဖွင့်ရန်</span></a>
                                <a href="{{ route('login') }}" class="btn btn-primary"><span language='eng'>Login
                                        Account</span><span language="mm">အကောင့်၀င်ရောက်ရန်</span></a>
                            @else
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfPGK5-MKWUiGIU8pXoqokXn1XQcXoXQQ_TmmQzKIGFZiKPSQ/viewform?usp=sf_link"
                                    class="btn btn-primary"><span language='eng'>Buy Member Plan</span><span
                                        language="mm">မန်ဘာ၀င်ရန်</span></a
                                    href="https://docs.google.com/forms/d/e/1FAIpQLSfPGK5-MKWUiGIU8pXoqokXn1XQcXoXQQ_TmmQzKIGFZiKPSQ/viewform?usp=sf_link">
                            @endif
                        </div>

                        <p>
                            <span language="eng">This is premium link!</span>
                            <span language="mm">မန်ဘာ၀င်များအတွက်သာဖြစ်ပါသည်</span>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('user/js/jquery.js') }}"></script>
    <script src="{{ asset('user/js/custom.js') }}"></script>
</body>

</html>
