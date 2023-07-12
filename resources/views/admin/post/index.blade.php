@extends('layouts.admin_master')
@section('title')
    Posts
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @livewire('admin.post.post-table')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            activeMenu('.side-post');
        });
    </script>
@endpush
