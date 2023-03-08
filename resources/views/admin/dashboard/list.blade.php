@extends('layouts.admin_master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-clapperboard"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Movies</span>
                    <span class="info-box-number">
                        {{ $totalMovies }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ratings</span>
                    <span class="info-box-number">{{ $totalRating }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <table>
                        @foreach ($userRoleCounts as $user)
                            <tr>
                                <td class="text-capitalize">{{ $user->role }}</td>
                                <td class="fw-bold"> {{ $user->total }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg- elevation-1"><i class="fa-solid fa-circle-dot"
                        style="color: green"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Users (Now)</span>
                    <span class="info-box-number">{{ $activeUsers }} persons</span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon"><i class="fa-solid fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">All Views</span>
                    <span class="info-box-number">{{ $totalViews }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fa-solid fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today Views</span>
                    <span class="info-box-number" id="todayViewCount">
                        @if ($todayView)
                            {{ $todayView->count }}
                        @else
                            0
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-primary">
                <span class="info-box-icon"><i class="fa-solid fa-cloud-arrow-down"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today Download</span>
                    <span class="info-box-number">
                        @if ($todayDownload)
                            {{ $todayDownload->count }}
                        @else
                            0
                        @endif
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="far fa-comment"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Comments</span>
                    <span class="info-box-number">{{ $totalComment }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger  elevation-1"><i
                        class="text-warning fa-solid fa-triangle-exclamation"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('admin#report') }}"><span class="info-box-text">Reports</span></a>
                    <span class="info-box-number">
                        {{ $reports }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4">
            <h5>Table FilterBy</h5>
            <div class="m-0 mb-2">
                <input type="date" value="" class="fromDate viewCountDate">
                <i class="fa-solid fa-arrow-right-long c"></i>
                <input type="date" value="" class="toDate viewCountDate">
            </div>
        </div>
        <div class="col-md-6 card p-3">
            <h5><i class="fa-regular fa-eye"></i> View Count Table</h5>
                <canvas style="height: 300px" id="viewCountTable"></canvas>
        </div>
        <div class="col-md-6 card p-3">
            <h5><i class="fa-solid fa-cloud-arrow-down"></i> Download Count Table</h5>
            <canvas  style="height: 300px" id="downloadCountTable"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('admin/dist/js/charts.js') }}"></script>
    <script>
        let _token = '{{ csrf_token() }}'
        $('.toDate').val(getDate());
        $('.fromDate').val(subDate(5))
        $(document).ready(function() {
            activeMenu('.side-movies-dashboard');
            getViewCount()
            $('.viewCountDate').change(function(e) {

                getViewCount()
            });
        });

        function getViewCount(not) {
            let to = $('.toDate').val();
            const toSplit = to.split('-');
            let from = $('.fromDate').val();
            $.ajax({
                type: "POST",
                url: "{{ route('admin#view_count') }}",
                data: {
                    to,
                    from,
                    _token
                },
                dataType: "JSON",
                success: function(response) {
                    $('#todayViewCount').html(response.today_view_count);
                    if (!not) {
                        //viewChart is call from admin/js/charts.js
                        viewChart.data.labels = response.view_table.map(row=>row.label);
                        viewChart.data.datasets[0].data = response.view_table.map(row=>row.count);

                        downloadChart.data.labels = response.download_table.map(row=>row.label);
                        downloadChart.data.datasets[0].data = response.download_table.map(row=>row.count);
                        viewChart.update();
                        downloadChart.update();
                    }
                }
            });
        }
    </script>
@endpush
