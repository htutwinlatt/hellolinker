@extends('layouts.admin_master')
@section('title')
    Users/{{$user->name}}/Edit
@endsection
@section('routes')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin#user_list') }}">Users</a></li>
                    <li class="breadcrumb-item active">@if(request('view')) View @else Edit @endif</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
        @if(request('view'))
        <a class="nav-link bg-success" href="{{route('admin#movie_edit',$movie->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        @endif
        <a class="nav-link bg-danger" href="{{route('admin#user_list')}}">Close</a>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Edit </h3>
            </div>
            <form action="{{route('admin#user_update',$user->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">User Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="member" @if($user->role == 'member') selected @endif>Member</option>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="text" placeholder="Enter Phone" minlength="5" name="phone" value="{{$user->phone}}" class="form-control">
                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Update Password</label>
                        <input type="text" minlength="6" name="password" class="form-control" placeholder="Enter Update Password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coin"><i class="fa-solid fa-circle-h"></i> Coins</label>
                        <input type="text" value="{{ $user->ctypto_points }}" maxlength="5" id="coin" name="coin" placeholder="Enter Coin Amount" class="form-control">
                        @error('coin')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-up-from-bracket"></i> Update</button>
                </div>
            </form>
        </div>
        <!-- Plan Change Section -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Plan Change
                    @if(strtotime($user->plan_end_date) <   time())
                    <span class="ml-2 badge text-bg-danger">Expire</span>
                    @else
                    <span class="ml-2 badge text-bg-success">Active</span>
                    @endif
                </h3>
                <h3 class="card-title float-end">@if($user->plan_end_date){{date('Y-m-d h:i:s A',strtotime($user->plan_end_date))}} @endif</h3>
            </div>
            <form action="{{route('admin#user_plan_change',$user->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Plan Add (Day)</label>
                        <input type="number" name="planEndDate" class="form-control" value="30">
                        @error('planEndDate')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-end    ">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Buy</button>
                </div>
            </form>
        </div>

        <!-- Other Butttons-->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Others</h3>
            </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                    @if($user->id != Auth::user()->id)
                        <form action="{{route('admin#user_destroy',$user->id)}}" method="POST" id="delForm" class="d-none">
                        @csrf
                        <input type="passwrd" name="password" class="delComPassword">
                        </form>
                        <button class="btn btn-danger m-1" id="delAccount"><i class="fa-solid fa-trash"></i> Delete Account</button>
                        @endif
                        <div class="position-relative">
                            <a href="{{route('admin#user_rm_device',$user->id)}}"  class="btn btn-warning m-1">
                                Remove Devices <span class="badge bg-danger">{{count($devices)}}</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Devices</h5>
                        @if(count($devices) > 0)
                        <ul class="list-group list-group-light">
                            @foreach ($devices as $device)
                            <li class="list-group-item text-light">{{$device->user_agent}} <br>
                                <span class="fw-bold text-muted"><i class="fa-regular fa-clock"></i> {{date('d-m-Y h:i:s A',$device->last_activity)}}</span>
                            </li>
                            @endforeach
                          </ul>
                          @else
                          -There is no Device to show!
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        activeMenu('.side-users');
    });

    //Del account
    $('#delAccount').click(function (e) {
        e.preventDefault();
        let text = prompt('Please Enter Your Password')
        if (text.length > 5) {
            $('.delComPassword').val(text)
            $('#delForm').submit();
        }else{
            $('#delAccount').click();
        }
    });
</script>
@endpush
