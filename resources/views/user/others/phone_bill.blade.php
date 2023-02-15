@extends('layouts.master')
@section('title')
    Hello Linker Lucky Draw
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row my-5 py-5">
            <div class="col-md-2"></div>
            <div class="col-md-4 m-0 p-0"`>
                <img src="{{ asset('user/img/congragulation.jpg') }}"
                style="height: 300px" class="card-img-top" alt="...">
            </div>
            <div class="col-md-4 m-0 p-0" >
                <div class="card m-0 p-0" style="height: 300px">

                    <div class="card-body">
                        <h4 class="text-center" style="color: gold">Phone Bill 1000 MMK Winner!</h4>
                        <form action="{{ route('user#lucky_add_phone') }}" method="POST" class="mt-4">
                            @csrf
                            <label for="inputPhone" class="my-2">Phone Number</label>
                            <input required id="inputPhone" name="phone" type="text" placeholder="phone number" class="form-control">
                            <div class="text-end mt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
