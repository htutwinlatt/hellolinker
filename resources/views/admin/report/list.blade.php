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
                    <div class="col-md-12 overflow-auto">
                        <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th>Movie</th>
                                    <th>Error Type</th>
                                    <th>Check</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($reports) > 0)
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td class=" align-middle">
                                                <img style="width:70px;height:70px"
                                                    src="@if ($report->movie->image) {{ asset('storage/movie_photos/' . $report->movie->image) }} @else {{ $report->movie->image_link }} @endif"
                                                    alt="">
                                                <a href="{{ route('admin#movie_edit', $report->movie->id) }}?view='true'">
                                                    <span class="movieId"
                                                        id="{{ $report->movie_id }}">{{ $report->movie->name }}</span>
                                                </a>
                                            </td>
                                            <td class=" align-middle"><span class="reportType">{{ $report->type }}</span>
                                                <span class="badge badge-primary">{{ $report->report_count }}</span></td>
                                            <td>
                                                <a href="{{ $report->movie->link }}" class="btn btn-link btn-sm">Link</a>
                                            </td>
                                            <td class=" align-middle">
                                                <div>
                                                    <button title="solved"
                                                        class="btn btn-success btn-sm mx-2 reportSolvedBtn"><i
                                                            class="fa-regular fa-square-check"></i></button>
                                                    <button title="more read" class="btn btn-sm btn-info moreReportInfo"
                                                        data-bs-toggle="modal" data-bs-target="#moreReadReport">
                                                        <i class="fa-solid fa-message"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4">There is no Reports.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="moreReadReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Report Comments</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group reportMessage">
                        {{-- <li class="list-group-item text-light">An item</li> --}}
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        $(document).ready(function() {
            activeMenu('.side-report')
            $('.moreReportInfo').click(function() {
                let parent = $(this).closest('tr');
                let mov_id = parent.find('.movieId').attr('id');
                let type = parent.find('.reportType').html();
                $('.reportMessage').html('Please Wait....');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#report_more') }}",
                    data: {
                        mov_id,
                        type,
                        _token
                    },
                    dataType: "JSON",
                    success: function(response) {
                        let text = '';
                        for (let i = 0; i < response.length; i++) {
                            if (response[i].remark != null) {
                                text += '<li class="list-group-item text-light">' + response[i]
                                    .remark + '</li>'
                            }
                        }

                        console.log(text);
                        if (text != '') {
                            $('.reportMessage').html(text);
                        } else {
                            $('.reportMessage').html('There is nothing to show!');
                        }
                    },
                    error: function(err) {
                        $('.reportMessage').html(err.statusText);
                    }
                });
            });
            $('.reportSolvedBtn').click(function() {
                let parent = $(this).closest('tr');
                let btn = $(this);
                $(this).hide(300);
                let mov_id = parent.find('.movieId').attr('id');
                let type = parent.find('.reportType').html();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin#report_solve') }}",
                    data: {
                        mov_id,
                        type,
                        _token
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Solved', '', 'success');
                            parent.remove();
                        }
                    },
                    error: function(err) {
                        btn.show(300);
                        Swal.fire('Error!', err.statusText, 'error');
                    }
                });
            })
        });
    </script>
@endpush
