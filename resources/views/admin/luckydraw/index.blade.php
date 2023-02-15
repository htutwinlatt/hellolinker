@extends('layouts.admin_master')
@section('title')
    Admin Lucky
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                @if ($control)
                <div class="card">
                    <div class="card-body  rounded-3">
                        Total Drawer - {{ $control->count }} <br>
                        Winner - {{ $control->winner_count }}
                        <div class="mt-2">
                            <button id="resetBtn" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lucky Winner Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-12 overflow-auto">
                            <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($winners) > 0)
                                        @foreach ($winners as $w)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td><u><a href="{{ route('admin#user_edit', $w->user->id) }}"
                                                            class="text-light">{{ $w->user->name }}</a></u></td>
                                                <td>{{ $w->user->email }}</td>
                                                <td>{{ $w->phone_number }}</td>
                                                <td>
                                                    @if ($w->status == 'winner')
                                                        <span class="badge bg-warning">{{ $w->status }}</span>
                                                    @elseif ($w->status == 'completed')
                                                        <span class="badge bg-success">{{ $w->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $w->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    @if ($w->status == 'winner')
                                                        <a href="{{ route('admin#lucky_complete', $w->id) }}"
                                                            class="btn btn-success">Complete</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="7">There is no Winner</td>
                                            </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.side-lucky_draw').addClass('active')
            $('#resetBtn').click(function(e) {
                e.preventDefault();
                if (confirm('Are you sure to reset lucky draw table')) {
                    window.location.href = '{{ route('admin#lucky_reset') }}'
                }
                return false;
            });
        });
    </script>
@endpush
