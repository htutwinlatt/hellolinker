@extends('layouts.admin_master')
@section('title')
    @if (request('view'))
        View
    @else
        Edit
    @endif Slideshow
@endsection
{{-- Route --}} @section('routes')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if (request('view'))
                            View
                        @else
                            Edit
                        @endif Slide Show
                    </h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin#slideshow_list') }}">Slideshows</a>
                        </li>
                        <li class="breadcrumb-item active">
                            @if (request('view'))
                                View
                            @else
                                Edit
                            @endif
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
            @if (request('view'))
                <a class="nav-link bg-success" href="{{ route('admin#slideshow_edit', $slide->id) }}"><i
                        class="fa-solid fa-pen-to-square"></i> Edit</a>
            @endif
            <a class="nav-link bg-danger" href="{{ route('admin#slideshow_list') }}">Close</a>
        </div>
    </div>
    @endsection @section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Form
                        @if (request('view'))
                            <span class="badge badge-danger">Disabled in view Mode</span>
                        @endif
                    </h3>
                </div>
                <form method="POST" action="{{ route('admin#slideshow_edit', $slide->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body row">
                        <div class="form-group">
                            <label for="idL">Id (Ascending by Id)</label>
                            <input type="text" name="eid"
                                class="form-control
                                @error('eid') is-invalid @enderror"
                                id="idL" value="{{ old('eid', $slide->id) }}" placeholder="Enter Title" />
                            @error('eid')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="titleL">Title</label>
                            <input type="text" name="title"
                                class="form-control
                                @error('title') is-invalid @enderror"
                                id="titleL" required value="{{ old('title', $slide->title) }}"
                                placeholder="Enter Title" />
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="trailerL">Description</label>
                            <textarea name="description" required placeholder="Enter Description"
                                class="form-control  @error('description') is-invalid @enderror" id="trailerL" rows="5"
                                placeholder="Enter Description">
                                {{ old('description', $slide->description) }}
                                </textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <a href="{{ asset('storage/slideShows/' . $slide->image) }}">
                                <img style="width: 200px" src="{{ asset('storage/slideShows/' . $slide->image) }}" class=""
                                    alt="">
                            </a>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imageL">Update Image</label>
                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror"
                                autocomplete="none" />
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="imglinkL">Image Link</label>
                            <input type="text"  class="form-control" name="imageLink" id="imglinkL"
                                value="{{ old('imageLink', $slide->image_link) }}" placeholder="Enter Title" />
                        </div>
                        <div class="form-group">
                            <label for="linkL">Link</label>
                            <input type="text" required class="form-control" name="link" id="linkL"
                                value="{{ old('link', $slide->link) }}" placeholder="Enter Title" />
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal For Movie Select-->
    <div class="modal fade" id="chooseFromMovie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" class="form-control" id="searchMovInput" placeholder="Enter Movie Name" />
                </div>
                <div class="modal-body">
                    <ul class="list-group searchMovResult">
                        <h5 class="text-center">Please Enter Movie Name</h5>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endsection @push('scripts')
    <script>
        $(document).ready(function() {
            activeMenu('.side-slideShows');
            $('.searchForm input').attr('disabled', true);

            //Search Movie
            $("#searchMovInput").keyup(function(e) {
                let searchKey = $(this).val();
                let searchKeyLength = searchKey.split(" ").join("").length;
                if (searchKeyLength < 1) {
                    $(".searchMovResult").html(
                        '<h5 class="text-center">Please Enter Movie Name</h5>'
                    );
                    return;
                }
                $(".searchMovResult").html(loading());
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin#slideshow_searchMov') }}",
                    data: {
                        searchKey,
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.length > 0) {
                            let list = "";
                            for (let i = 0; i < data.length; i++) {
                                list += `<a href="{{ route('admin#slideshow_insertPage') }}?selectMovie=${data[i].id}">
                            <li class="list-group-item text-light">${data[i].name}</li>
                            </a>`;
                            }
                            $(".searchMovResult").html(list);
                        } else {
                            $(".searchMovResult").html(
                                "There is no movie like " + searchKey
                            );
                        }
                    },
                });
            });
        });
    </script>
    @if (request('view'))
        <script>
            $(document).ready(function() {
                $('input , textarea').attr('disabled', true);
            });
        </script>
    @endif
@endpush
