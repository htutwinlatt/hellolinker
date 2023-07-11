@extends('layouts.admin_master')

@section('title')
    Post Create
@endsection

@section('routes')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert Application</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('application.index') }}">Application</a>
                        </li>
                        <li class="breadcrumb-item active">Insert</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
            <a class="nav-link bg-danger" href="{{ route('application.index') }}">Close</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Movie</h3>
                </div>
                <form action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Version Name</label>
                            <input type="text" value="{{ old('version') }}" name="version" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Key</label>
                            <input type="text" name="key" value="{{ old('key') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Application</label>
                            <input type="file" name="application" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="status" type="checkbox" value="{{ old('status',1) }}" id="isActive" checked>
                                <label class="form-check-label" for="isActive">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="buttom" class="btn btn-primary">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
