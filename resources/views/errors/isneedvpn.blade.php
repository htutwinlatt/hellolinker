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

            <div class="col-md-12  error-main">

                <div class="row">

                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">

                        <h1 class="m-0">404</h1>

                        <h6><span class="my-5">Please Open Vpn ပုံများအပြည့် အစုံတွေ့နိင်ရန် VPN လေး ဖွင့် ပေးပါ</span>

                            <div class="my-3">
                                မန်ဘာ၀င်ဖြစ်ပါ က <a href="{{ route('login') }}">Login</a> ၀င်ပါ
                            </div>

                            <p style="line-height: 30px">

                                ကြော်ငြာများ နှင့် မကြည့် တတ်ပါ က တစ် လကို 1000 ကျပ်ဖြင့် Member ၀င်ပြီး
                                VPN ခံစရာမလိုပဲ ကြည့်ရှုနိုင်ပါသည်<br>
                                မန်ဘာ၀င်ရန် <a href="https://www.facebook.com/HelloLinker?mibextid=ZbWKwL">Hello Linker Facebook Messenger</a>
                                မှာမေးမြန်းနိုင်ပါတယ်
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
