@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="row">
                <h4 class="text-center"> Profile</h4>
                <div class="line-mf"></div>
                <div class="">
                    <a href="javascript:history.back()" title="back page" class="btn btn-primary"><i
                            class="fs-6 fa-solid fa-arrow-left-long"></i></a>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3 d-flex justify-content-center">
                <a href="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}"
                            class="rounded rounded-circle" width="200" height="200" alt="">
                    @else
                        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo_path) }}"
                            class="rounded rounded-circle" height="200" alt="">
                    @endif

                </a>
            </div>
            <div class="col-md-7">
                <div class="row mt-3">
                    <div class="col-md-7 userProfile">
                        <div class="forShow">
                            <h5 class="mb-3"><span language='eng'>Name</span><span language="mm">အမည်</span> :
                                {{ Auth::user()->name }}</h5>
                            <h5 class="mb-3"><span language='eng'>User Id</span><span language="mm">အိုင်ဒီ</span> :
                                <span class="text-muted">uid-{{ Auth::user()->id }}</span>
                            </h5>
                            <h5 class="mb-3"><span language='eng'>Plan End Date</span><span
                                    language="mm">အစီအစဉ်ကုန်ဆုံးရက်</span> :
                                @if (Auth::user()->plan_end_date)
                                    <small>{{ date('d-m-Y | h:i:s A', strtotime(Auth::user()->plan_end_date)) }}</small>
                                @endif
                            </h5>
                            <h5 class="mb-3"><span language='eng'>Data</span><span language="mm">အချက်အလက်</span> : <span
                                    class="badge bg-primary">
                                    <i class="fa-solid fa-person-half-dress"></i> {{ Auth::user()->gender }}</span>
                                <span class="badge bg-secondary">
                                    <i class="fa-solid fa-clipboard-user"></i> {{ Auth::user()->role }}</span>
                                @if (strtotime(Auth::user()->plan_end_date) < time())
                                    <span class="ml-2 badge  bg-danger">Plan Expired</span>
                                @else
                                    <span class="ml-2 badge bg-success">Plan Active</span>
                                @endif
                            </h5>
                            <h5 class="mb-3"><i class="fa-solid fa-envelope"></i> {{ Auth::user()->email }}</h5>
                            <h5 class="mb-3"><i class="fa-solid fa-circle-h"></i> {{ Auth::user()->ctypto_points }} <small
                                    class="text-muted">coins</small></h5>
                            <div>
                                <a href="" class="btn btn-outline-light w-100 my-2"><i
                                        class="fa-solid fa-arrow-rotate-right"></i> Refresh</a>
                                <button type="button" class="btn btn-primary  w-100 " id="editProfileBtn"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</button>
                                <button type="button" class="btn btn-primary w-100  my-2" id="editPassBtn"><i
                                        class="fa-solid fa-key"></i>
                                    Change Password</button>
                            </div>
                        </div>
                        {{-- Forms --}}
                        <form class="d-none" id="upDateProfileForm" enctype="multipart/form-data">
                            @csrf
                            <div class="my-2">
                                <label class="form-label m-0" for="nameInput">
                                    <span language='eng'>Name</span><span language='mm'>အမည်</span>
                                </label>
                                <input value="{{ Auth::user()->name }}" type="text" name="name" id="nameInput"
                                    class="form-control name" required autocomplete="off">
                            </div>
                            <!-- Email input -->
                            <div class="my-2">
                                <label class="form-label m-0" for="emailInput">
                                    <span language='eng'>Email</span><span language='mm'>အီးမေးလ်လိပ်စာ</span>
                                </label>
                                <input value="{{ Auth::user()->email }}" type="email" name="email" id="emailInput"
                                    class="form-control  email" required autocomplete="off">
                            </div>
                            <!-- Gender input -->
                            <div class="my-2">
                                <label class="form-label m-0" for="genderL">
                                    <span language='eng'>Gender</span><span language='mm'>သတ်မှတ်ပါ</span>
                                </label>
                                <select name="gender" class="form-control bg-dark gender" id="genderL">
                                    <option value="">Select Gender ....</option>
                                    <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                    <option value="rather" @if (Auth::user()->gender == 'rather') selected @endif>Rather not to
                                        say</option>

                                </select>
                            </div>
                            <!-- Profile Image input -->
                            <div class="my-2">
                                <label class="form-label m-0" for="">
                                    <span language='eng'>Profile Photo</span><span language='mm'>ပရိုဖိုင်း ဓာတ်ပုံ
                                    </span>
                                    <input type="file" class="form-control" name="profileImage">
                                </label>
                            </div>
                            <div class="my-3 float-end">
                                <button type="button" back="ture" class="btn btn-dark">Back</button>
                                <button type="submit" class="btn btn-primary infoUpdateSubmitBtn">Update</button>
                            </div>
                        </form>

                        <form action="" class="d-none" id="upDatePasswordForm">
                            @csrf
                            <div class="my-2">
                                <label class="form-label m-0" for="oldPassword">
                                    <span language='eng'>Old Password</span><span language='mm'>စကား၀ှက် အဟောင်း</span>
                                </label>
                                <input value="" type="password" name="password" placeholder="" id="oldPassword"
                                    class="form-control" autocomplete="off">
                            </div>
                            <!--New Password input -->
                            <div class="my-2">
                                <label class="form-label m-0" for="password">
                                    <span language='eng'>New Password</span><span language='mm'>စကား၀ှက် အသစ်</span>
                                </label>
                                <input value="" type="password" name="newPassword" id="password"
                                    class="form-control" autocomplete="off">
                            </div>
                            <!-- New C Password input -->
                            <div>
                                <label class="form-label m-0" for="c_password">
                                    <span language='eng'>Confirm New Password</span><span language='mm'>စကား၀ှက် အသစ်
                                        ကိုအတည်ပြုပါ</span>
                                </label>
                                <input value="" type="password" name="newConfirmPassword" id="c_passwords"
                                    class="form-control" autocomplete="off">
                            </div>
                            <div class="my-4 float-end">
                                <button type="button" back="ture" class="btn btn-dark">Back</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let _token = '{{ csrf_token() }}'
            formShow('#editProfileBtn', '#upDateProfileForm');
            formShow('#editPassBtn', '#upDatePasswordForm');
            //Update Profile Info
            $('#upDateProfileForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                ajaxForm(formData, '{{ route('user#up_profile') }}', after.updateProfile());
            });

            $('#upDatePasswordForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                ajaxForm(formData, '{{ route('user#up_password') }}', after.updatePassword());

            });


            $('button').click(function() {
                if ($(this).attr('back')) {
                    $(`.userProfile form`).addClass(`d-none`);
                    $(`.forShow`).removeClass('d-none');
                }
            })
        });


        //AfterUpdate Addition Function
        const after = {
            updateProfile: function() {
                $('input[name="profileImage"]').val('');
            },
            updatePassword: function() {
                $('#upDatePasswordForm input[autocomplete="off"]').val('');
            }
        }
        //Run After Profile update,response from Server
        function afterUpdate(data, type) {
            type;
            if (data.errors) {
                let errors = '';
                data.errors.forEach(error => {
                    errors += `${error}`;
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errors,
                })

            }
            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: data.success,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
                if (data.refresh) {
                    setTimeout(() => {
                        window.location.href = '{{ route('login') }}'
                    }, 3000);
                }
            }

        }
        // Need to declare
        function ajaxForm(formData, route, type) {
            $.ajax({
                type: 'POST',
                url: route,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    afterUpdate(data, type);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        let formShow = (btn, form) => {
            $(btn).click(function(e) {
                e.preventDefault();
                $(`.userProfile form , .forShow`).addClass(`d-none`);
                $(form).removeClass(`d-none`);
            });
        }
    </script>
@endpush
