<div class="card">
    <div class="card-header">
        <h3 class="card-title">Posts Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="col-md-12 text-end my-2">
            <a href="{{ route('posts.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                Insert</a>
        </div>
        <div class="row">
            <div class="col-md-12 overflow-auto">
                <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                    aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Title</th>
                            <th style="width: 10px">More</th>
                        </tr>
                    </thead>
                    <tbody id="sortable" class="slideShowContainer">
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('posts.edit', $post->id) }}" title="edit movie"
                                            class="btn-sm m-1  btn-primary editSlideBtn"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a wire:click='delete({{ $post->id }})'
                                            onclick="event.preventDefault();return confirm('Are you Sure to Deleted?')"
                                            title="remove" class="btn-sm m-1  btn-primary"><i
                                                class="fa-solid fa-trash"></i></a>
                                        <a href="" title="more" class="btn-sm m-1  btn-primary"><i
                                                class="fa-solid fa-ellipsis"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div>{{ $posts->appends(request()->query())->links() }}</div>
        </div>
    </div>
    <!-- /.card-body -->

</div>
