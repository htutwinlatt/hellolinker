@extends('layouts.admin_master')
@section('title')
    Movies
@endsection
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Movie Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">Search Key : {{ request('searchKey') }}</div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="col-md-12 text-end my-2">
                            <div class=" d-inline">
                                <form action="{{ route('admin#separate_category') }}" class="d-none autoSeparateForm" method="POST">
                                    @csrf
                                    <input type="text" name="autoSeparate" value="true">
                                </form>
                                <button class="btn btn-warning autoSeparateBtn"><i
                                        class="fa-solid fa-wand-magic-sparkles"></i> Auto Separate Movies | Series</button>
                            </div>
                            <button href="{{ route('admin#movie_insert') }}" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#advanceSearchModal"><i class="fa-brands fa-searchengin"></i> Advance
                                Search</button>
                            <a href="{{ route('admin#movie_insert') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Insert</a>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 overflow-auto">
                                <table id="movieTable"
                                    class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                                    aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Image</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Studio</th>
                                            <th>Uploaded At</th>
                                            <th class="col-1">More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($movies as $movie)
                                            <tr class="align-middle">
                                                <td><a
                                                        href="@if ($movie->image == null) {{ $movie->image_link }} @else {{ asset('storage/movie_photos/' . $movie->image) }} @endif"><img
                                                            class="w-100" height="80"
                                                            src="@if ($movie->image == null) {{ $movie->image_link }} @else {{ asset('storage/movie_photos/' . $movie->image) }} @endif"
                                                            alt=""></a></td>
                                                <td>{{ $movie->name }}
                                                    @if ($movie->role != 'free')
                                                        <i class="fa-solid fa-crown text-warning"></i>
                                                    @endif
                                                    <br>
                                                    @if ($movie->category == 'series')
                                                        <span class="badge badge-danger text-uppercase">
                                                            {{ $movie->category }}
                                                        </span>
                                                        @if ($movie->complete == 1)
                                                            <span class="badge badge-success text-uppercase">
                                                                Completed
                                                            </span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $types = explode(',', $movie->type);
                                                    @endphp
                                                    @foreach ($types as $type)
                                                        <span
                                                            class="badge badge-primary text-uppercase">{{ $type }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $movie->studio }}</td>
                                                <td>{{ $movie->created_at->format('d-M-Y') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <a href="{{ route('admin#movie_edit', $movie->id) }}"
                                                            title="edit movie" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="" title="more" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-clock-rotate-left"></i></a>
                                                        <a href="{{ route('admin#movie_edit', $movie->id) }}?view='true'"
                                                            title="more" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-ellipsis"></i></a>
                                                        <a href="{{ route('admin#movie_delete', $movie->id) }}"
                                                            onclick="return confirm('Are you sure to delete this')"
                                                            title="delete" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div>{{ $movies->appends(request()->query())->links() }}</div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <!-- Advance Search Modal -->
        <div class="modal fade" id="advanceSearchModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Advance Search</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin#mov_adv_search') }}" method="GET">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="catAdvSeh" class=" form-label">Category</label>
                                    <select required name="category" id="catAdvSeh" class="form-select">
                                        <option value="">Choose...</option>
                                        <option value="movies" @if (request('category') == 'movies') selected @endif>Movies
                                        </option>
                                        <option value="series" @if (request('category') == 'series') selected @endif>Series
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="compAdvSeh" class=" form-label">Complete</label>
                                    <select name="complete" id="compAdvSeh" class=" form-select">
                                        <option value="">All</option>
                                        <option value="yes" @if (request('complete') == 'yes') selected @endif>yes
                                        </option>
                                        <option value="no" @if (request('complete') == 'no') selected @endif>no
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Search Key</label>
                                    <input type="text" autocomplete="none" value="{{ request('key') }}"
                                        name="key" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            activeMenu('.side-movies', '.side-movies-list');
            $('.searchForm').attr('action', '{{ route('admin#movie_list') }}');

            if ('{{ request('searchKey') }}') {
                $('.searchForm input').val('{{ request('searchKey') }}');
            }

            $('.autoSeparateBtn').click(function() {
                const result = confirm('Are you sure to auto seprate movies and series');
                if (result) {
                    $('.autoSeparateForm').submit();
                }
            })
        });
    </script>
@endpush
