@extends('layouts.admin_master')
@section('title')
    Applications
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Applications Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12 text-end my-2">
                        <a href="{{ route('application.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                            Insert</a>
                    </div>
                    <div class="row">
                        <div class="col-md-12 overflow-auto">
                            <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th style="width: 10px">Version</th>
                                        <th style="width: 10px">Status</th>
                                        <th>Key</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable" class="slideShowContainer">
                                    @foreach ($applications as $app)
                                        <tr>
                                            <td>{{ $app->id }}</td>
                                            <td>{{ $app->version }}</td>
                                            <td>
                                                <div class="changeAppStatus" movie_id="{{ $app->id }}">
                                                    @include('components.badge', [
                                                        'status' => $app->status,
                                                    ])
                                                </div>
                                            </td>
                                            <td>{{ $app->key }}</td>
                                            <td>{{ $app->created_at }}</td>
                                            <td>{{ $app->updated_at }}</td>
                                            <td>
                                                <div class="d-flex justify-content-evenly">
                                                    {{-- <a href="{{ route('application.edit', $app->id) }}" title="edit movie"
                                                        class="btn-sm m-1  btn-primary editSlideBtn"><i
                                                            class="fa-solid fa-pen-to-square"></i></a> --}}
                                                    <form action="{{ route('application.destroy', $app->id) }}"
                                                        method="POST" id="appDeleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="d-none" type="text" value="{{ $app->id }}">
                                                        <button type="submit" title="remove" class="btn-sm m-1 btn-primary"
                                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div>{{ $posts->appends(request()->query())->links() }}</div> --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}';
        $(document).ready(function() {
            activeMenu('.side-application');
            $('.changeAppStatus').click(function(e) {
                e.preventDefault();
                const that = $(this);
                const id = that.attr('movie_id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#change_status') }}",
                    data: {
                        id,
                        _token
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            that.html(response.success)
                        }
                    }
                });
            });
        });
    </script>
@endpush
