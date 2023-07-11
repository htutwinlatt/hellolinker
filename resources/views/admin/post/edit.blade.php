@extends('layouts.admin_master')
@section('title')
Post Edit
@endsection

@section('routes')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Post</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('posts.index') }}">Posts</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
            <a class="nav-link bg-danger" href="{{ route('posts.index') }}">Close</a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        @livewire('admin.post.post-edit',['postId' => $id])
    </div>
</div>
@endsection
