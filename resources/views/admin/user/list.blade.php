@extends('layouts.admin_master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="my-3">
                        <h5><span>Search Key : </span><code>{{ request('searchKey') }}</code></h5>
                        <form class="float-right d-flex my-2" id="filterForm" action="{{ route('admin#user_list') }}"
                            method="GET">
                            <select name="filterBy" class="form-select" id="">
                                <option value="">All</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role }}" class=""
                                        @if (request('filterBy') == $role->role) selected @endif>
                                        {{ strtoupper($role->role) }}({{ $role->total }})
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-md-12 overflow-auto">
                        <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="width: 40px">Role</th>
                                    <th>Plan End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><u><a href="{{ route('admin#user_edit', $user->id) }}"
                                                    class="text-light">{{ $user->name }}</a></u></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->plan_end_date }}
                                            @if (strtotime($user->plan_end_date) < time())
                                                <span class="ml-2 badge text-bg-danger">Expire</span>
                                            @else
                                                <span class="ml-2 badge text-bg-success">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            activeMenu('.side-users');
            $('#filterForm select').change(function(e) {
                e.preventDefault();
                $('#filterForm').submit();
            });
        });
    </script>
@endpush
