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
                <span class="info-box-icon bg-danger  elevation-1"><i class="text-warning fa-solid fa-triangle-exclamation"></i></span>

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
        <div class="col-md-12 card p-3">
            <h5><i class="fa-regular fa-eye"></i> View Count Table</h5>
            <div class="row">
                <div class="m-0 mb-2">
                    <input type="date" value="" class="fromDate viewCountDate">
                    <i class="fa-solid fa-arrow-right-long c"></i>
                    <input type="date" value="" class="toDate viewCountDate">
                </div>
            </div>
            <div id="viewCountChart"  class="rounded"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}'
        $('.toDate').val(getDate());
        $('.fromDate').val(subDate(5))

        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChartViewCount);

        function drawChartViewCount(dataArray) {
            // Set Data
            var data = google.visualization.arrayToDataTable(dataArray);
            // Set Options
            var options = {
                title: 'Date & View Count',
                is3D:true,
                hAxis: {
                    title: 'Date'
                },
                vAxis: {
                    title: 'View Count'
                },
                legend: 'none'
            };
            // Draw
            var chart = new google.visualization.LineChart(document.getElementById('viewCountChart'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            activeMenu('.side-movies-dashboard');
            // google.charts.setOnLoadCallback(drawChartViewCount);
            getViewCount()
            $('.viewCountDate').change(function(e) {
                getViewCount()
            });

            setInterval(() => {
                let not = true;
                getViewCount(not)
            }, 2000);
        });

        function getViewCount(not) {
            let to = $('.toDate').val();
            const toSplit =  to.split('-');
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
                    $('#todayViewCount').html(response.today_view_count)
                    if (!not) {
                        let data = [
                        ['Date', 'view'],
                    ];
                    for (let i = 0; i < response.view_table.length; i++) {
                        let array = [];
                        array.push(getDate(response.view_table[i].created_at))
                        array.push(parseInt(response.view_table[i].count));
                        data.push(array);
                    }
                    setTimeout(() => {
                        drawChartViewCount(data)
                    }, 200);
                    }
                }
            });
        }
    </script>
@endpush
