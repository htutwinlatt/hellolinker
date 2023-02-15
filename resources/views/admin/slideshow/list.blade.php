@extends('layouts.admin_master')
@section('title')
    Slideshows
@endsection
@section('styles')
    <style>
        .moveSlideshow {
            color: #343A40;
            cursor: move;
            ;
        }

        .moveSlideshow:hover {
            color: white
        }

        .dragging {
            opacity: .5;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12 text-end my-2">
                        <a href="{{ route('admin#slideshow_insertPage') }}" class="btn btn-primary"><i
                                class="fa-solid fa-plus"></i> Insert</a>
                    </div>
                    <div class="col-md-12 overflow-auto">
                        <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th style="width: 10px">More</th>
                                </tr>
                            </thead>
                            <tbody id="sortable" class="slideShowContainer">
                                @foreach ($slideShows as $slide)
                                    <tr draggable="true" sid="{{ $slide->id }}" class="draggablesSlideShow">
                                        <td class=" align-middle">
                                            <i class="fa-solid fa-grip-lines-vertical  p-2 rounded moveSlideshow"></i>
                                        </td>
                                        <td><a
                                                href="@if ($slide->image == null) {{ $slide->image_link }} @else {{ asset('storage/slideShows/' . $slide->image) }} @endif">
                                                <img width="100" height="50"
                                                    src="@if ($slide->image == null) {{ $slide->image_link }} @else {{ asset('storage/slideShows/' . $slide->image) }} @endif"
                                                    alt=""></a></td>
                                        <td>{{ $slide->title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="{{ route('admin#slideshow_edit', $slide->id) }}" title="edit movie"
                                                    class="btn-sm m-1  btn-primary editSlideBtn"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('admin#slideshow_destroy', $slide->id) }}"
                                                    onclick="return confirm('Are you Sure to Deleted?')" title="remove"
                                                    class="btn-sm m-1  btn-primary"><i class="fa-solid fa-trash"></i></a>
                                                <a href="{{ route('admin#slideshow_edit', $slide->id) }}?view=true"
                                                    title="more" class="btn-sm m-1  btn-primary"><i
                                                        class="fa-solid fa-ellipsis"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{-- {{ $users->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let _token = '{{ csrf_token() }}';
        $(document).ready(function() {
            activeMenu('.side-slideShows');
            $('.searchForm input').attr('disabled', true);

        });

        $(function() {
            let oldId = '';
            $("#sortable").sortable({
                // classes: {
                //     "ui-sortable": "highlight"
                // },
                start: function(event, ui) {
                    // oldId = ui.item.index() + 1;
                },
                update: function(event, ui) {
                    let slide = ui.item[0];
                    const position = ui.item.index() + 1;
                    const sid = $(slide).attr('sid');
                    console.log('p'+position);
                    console.log('id'+sid);
                    $("#sortable").sortable("disable");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin#slideshow_sort') }}",
                        data: {
                            position,
                            sid,
                            _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            let upTboday = ``;
                            data.forEach(slide => {
                                upTboday += `<tr draggable="true" sid="` + slide
                                    .id + `" class="draggablesSlideShow">
                                        <td class=" align-middle">
                                            <i class="fa-solid fa-grip-lines-vertical  p-2 rounded moveSlideshow"></i>
                                        </td>
                                        <td>`;
                                if (slide.image == null) {
                                    upTboday += `<a
                                                href="` + slide.image_link + `">
                                                <img width="100" height="50"
                                                    src="` + slide.image_link + `"
                                                    alt=""></a>`;
                                } else {
                                    upTboday += `<a
                                                href="` + slide.image + `">
                                                <img width="100" height="50"
                                                    src="` + slide.image + `"
                                                    alt=""></a>`;
                                };
                                upTboday += `</td>
                                        <td>` + slide.title + `</td>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="{{ url('admin/slideShows/edit') }}/`+slide.id+`" title="edit movie"
                                                    class="btn-sm m-1  btn-primary editSlideBtn"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ url('admin/slideShows/destroy') }}/`+slide.id+`"
                                                    onclick="return confirm('Are you Sure to Deleted?')" title="remove"
                                                    class="btn-sm m-1  btn-primary"><i class="fa-solid fa-trash"></i></a>
                                                <a href="{{ url('admin/slideShows/edit') }}/`+slide.id+`?view=true"
                                                    title="more" class="btn-sm m-1  btn-primary"><i
                                                        class="fa-solid fa-ellipsis"></i></a>
                                            </div>
                                        </td>
                                    </tr>`;


                            });
                            $('.slideShowContainer').html(upTboday);
                            $("#sortable").sortable("enable");
                        },
                        error: function() {
                            Swal.fire('error','Server Error!','error');
                            setTimeout(() => {
                                window.location.reload()
                            }, 1000);
                        }
                    });

                }
            });
        });
    </script>
@endpush
